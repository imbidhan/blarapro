<?php

namespace App\Modules\Accesslevel\Http\Controllers;

use App\Admin;

use Illuminate\Http\Request;
use App\Models\AccessLevel\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    #User list
    public function index()
    {
        $id =  Auth::guard("admin")->user()->id;
        $users = Admin::whereNotIn('id', [$id])->whereIn("type",[1,3])->get();
        return view('accesslevel::users.index', compact('users'));
    }

    #User create
    public function create()
    {
        $roles = Role::all();
        return view('accesslevel::users.create' , compact('roles'));
    }

    #User store
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:admins',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'role_id'               => 'required',
            //'pcMac'                 => 'required|unique:admins',
        ],[
            'name.required' => 'User name required',
            'email.required' => 'Email is required',
            'email.email' => 'Email format invalid',
            'email.unique' => 'Email already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password minimum 8 character',
            'password.confirmed' => 'Password and confirm password not match',
            'password_confirmation.required' => 'Confirm password is required',
            'password_confirmation.min' => 'Confirm password  minimum 8 character',
            'role_id.required' => 'Role is required',
        ]);


        try{

            if ($request->file('image')) {

                $fileInfo = $request->file('image');
                $imageExt = strtolower($fileInfo->getClientOriginalExtension());
                $size = $fileInfo->getSize();
                $kb = $size / 1024;

                $check=in_array($imageExt,['jpg','png','gif']);

                if (in_array($imageExt,['jpg','png','gif']) == false) {
                    Toastr::warning("Opps! Upload only jpg , png , gif format","Warning!");
                    return redirect()->route('user_create_access_level');
                }

                if ($kb > 200) {
                    Toastr::warning("Opps! file size less then 200 KB.","Warning!");
                    return redirect()->route('user_create_access_level');
                }

                $uniqueName = "thump_" . time() . rand() . "." . strtolower($imageExt);
                $folderName = "backend/uploads/users/";
                $fileInfo->move($folderName, $uniqueName);
                $imageDbPath = $folderName . $uniqueName;
            }
            $username    = explode("@", trim(strip_tags($request->email)));
            $admin = new Admin();

            $admin->role_id  = $request->role_id;
            $admin->name     = trim(strip_tags($request->name));
            $admin->username     = $username[0];
            $admin->email    = trim(strip_tags($request->email));
            $admin->phone    = trim(strip_tags($request->phone));

            if ($request->file('image')) {
                $admin->image  = $imageDbPath;
            }

            $admin->type     = 1;
            //$admin->pcMac    = trim(strip_tags($request->pcMac));
            $admin->password = bcrypt(trim(strip_tags($request->password)));
            $admin->save();

            Toastr::success("User created Successfully","Success!");
            return redirect()->route('user_create_access_level');

        }catch(Exception $e){
            Toastr::error("Sorry something went wrong! Data cannot created successfully!","Danger!");
            return redirect()->route('user_create_access_level');
        }


    }

    #User edit
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::all();

        return view('accesslevel::users.edit' , compact('user' , 'roles'));

    }

    #User update
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if($admin->email == $request->email){
            $this->validate($request, [
                'name' => 'required',
                'role_id' => 'required'
            ]);
        }
        else{
            $this->validate($request, [
                'name'  => 'required',
                'email' => 'required|email|unique:admins',
                'role_id' => 'required'
            ]);
        }


        try{

            if ($request->file('image')) {

                $fileInfo = $request->file('image');
                $imageExt = strtolower($fileInfo->getClientOriginalExtension());
                $size = $fileInfo->getSize();
                $kb = $size / 1024;

                $check=in_array($imageExt,['jpg','png','gif']);

                if (in_array($imageExt,['jpg','png','gif']) == false) {
                    Toastr::warning("Opps! Upload only jpg , png , gif format","Warning!");
                    return redirect()->route('user_create_access_level');
                }

                if ($kb > 200) {
                    Toastr::warning("Opps! file size less then 200 KB.","Warning!");
                    return redirect()->route('user_create_access_level');
                }

                if($admin->image){
                    unlink($admin->image);
                }

                $uniqueName = "thump_" . time() . rand() . "." . strtolower($imageExt);
                $folderName = "backend/uploads/users/";
                $fileInfo->move($folderName, $uniqueName);
                $imageDbPath = $folderName . $uniqueName;
            }
            $username    = explode("@", trim(strip_tags($request->email)));
            $admin->role_id  = trim(strip_tags($request->role_id));
            $admin->name     = trim(strip_tags($request->name));
            $admin->username = $username[0];
            $admin->email    = trim(strip_tags($request->email));
            $admin->phone    = trim(strip_tags($request->phone));

            if ($request->file('image')) {
                $admin->image  = $imageDbPath;
            }

            $admin->type     = 1;
            $admin->save();

            Toastr::success("User updated Successfully","Success!");
            return redirect()->route('user_edit_access_level',['id' => $id]);

        }catch(Exception $e){
            Toastr::error("Sorry something went wrong! Data cannot updated successfully!","Danger!");
            return redirect()->route('user_edit_access_level',['id' => $id]);
        }

    }

    #User role

    public function userRole($id)
    {
        $roles = Role::all();
        $user = Admin::find($id);

        return view('accesslevel::users.role', compact('id', 'roles', 'user'));
    }

    #user role update
    public function updateUserRole(Request $request, $id)
    {
        $this->validate($request, [
            'role_id' => 'required',
        ]);

        try {

            $user = Admin::find($id);
            $user->role_id = $request->role_id;
            $user->update();

            Toastr::success("User role updated successfully.","Success!");
            return redirect()->route('user_role', ['id' => $id]);

        }catch(Exception $e){
            Toastr::error("Sorry something went wrong! Data cannot updated successfully!","Danger!");
            return redirect()->route('user_role',['id' => $id]);
        }
    }

    #Change password view
    public function password($id)
    {
        return view('accesslevel::users.password', compact('id'));
    }

    #Update password
    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);



        try {

            $user = Admin::find($id);
            $user->password = bcrypt($request->password);
            $user->update();

            Toastr::success("User password changed Successfully.","Success!");
            return redirect()->route('user_password', ['id' => $id]);

        }catch(Exception $e){
            Toastr::error("Something went wrong! Cannot change password!","Danger!");
            return redirect()->route('user_password',['id' => $id]);
        }

    }

    #Admin change status
    public function adminUserChangeStatus(Request $request) {
        //return $request->all();
        try {
            $admin = Admin::find($request->id);
            $admin->status = trim(strip_tags($request->status));
            $admin->save();
            Toastr::success("User status change successfully","Success!");
            return redirect()->back();
        }catch(Exception $e){
            Toastr::error("Something went wrong!","Danger!");
            return redirect()->back();
        }
    }

    public function dashboardUserProfile() {
        $user = Admin::where("id",Auth::guard("admin")->user()->id)->first();
        return view('accesslevel::users.profile', compact('user'));
    }

    public function dashboardUserProfileUpdate(Request $request) {

        $admin = Admin::where("id",Auth::guard("admin")->user()->id)->first();

        $this->validate($request, [
            'name'  => 'required',
            'phone' => 'required',
        ]);

        try{

            if ($request->file('image')) {

                $fileInfo = $request->file('image');
                $imageExt = strtolower($fileInfo->getClientOriginalExtension());
                $size = $fileInfo->getSize();
                $kb = $size / 1024;

                $check=in_array($imageExt,['jpg','png','gif']);

                if (in_array($imageExt,['jpg','png','gif']) == false) {
                    Toastr::warning("Opps! Upload only jpg , png , gif format","Warning!");
                    return redirect()->back();
                }

                if ($kb > 200) {
                    Toastr::warning("Opps! file size less then 200 KB.","Warning!");
                    return redirect()->back();
                }

                if($admin->image != null){
                    unlink($admin->image);
                }

                $uniqueName = "thump_" . time() . rand() . "." . strtolower($imageExt);
                $folderName = "backend/uploads/users/";
                $fileInfo->move($folderName, $uniqueName);
                $imageDbPath = $folderName . $uniqueName;
            }

            $admin->name     = trim(strip_tags($request->name));
            $admin->phone    = trim(strip_tags($request->phone));

            if ($request->file('image')) {
                $admin->image  = $imageDbPath;
            }

            $admin->save();

            Toastr::success("User updated Successfully","Success!");
            return redirect()->back();

        }catch(Exception $e){
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();
        }
    }

    public function changeAdminUserPassword()
    {
        return view('accesslevel::users.changeAdminPassword');
    }

    public function updateAdminUserPassword(Request $request) {
        $user = Admin::where("id",Auth::guard("admin")->user()->id)->first();


        $this->validate($request, [
            'oldPassword'           => 'required',
            'password'              => 'required|confirmed|string|min:8',
            'password_confirmation' => 'required',
        ],[
            "oldPassword.required" => "Old password is required",
            "password.required" => "Password is required",
            "password_confirmation.required" => "Confirm password required",
            "password_confirmation.confirmed" => "New and confirm password not match",
        ]);

        try {

            $admin = Admin::where("id",Auth::guard("admin")->user()->id)
                ->where("status",1)->first();
            //return $admin;

            if(Hash::check(trim(strip_tags($request->oldPassword)), $admin->password)) {
                $user->password = bcrypt($request->password);
                $user->update();

                Toastr::success("Password changed Successfully","Success!");
                return redirect()->back();
            }else{
                Toastr::warning("Sorry! Your old password not match!","warning!");
                return redirect()->back();
            }
        }catch(Exception $e){
            Toastr::error("Something went wrong!","warning!");
            return redirect()->back();
        }

    }

}
