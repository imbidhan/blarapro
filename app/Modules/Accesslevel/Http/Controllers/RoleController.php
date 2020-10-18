<?php

namespace App\Modules\Accesslevel\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use App\Models\AccessLevel\Role;
use App\Models\AccessLevel\Modules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessLevel\AccessLevel;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('accesslevel::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('accesslevel::roles.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Role name required',
            'description.required' => 'Role description required',
        ]);

        try
        {
            $role_data = $request->all();
            $user_id = Auth::guard("admin")->user()->id;

            $role = new Role;
            $role->name        = trim(strip_tags($role_data['name']));
            $role->description = trim(strip_tags($role_data['description']));
            $role->created_by  = $user_id;
            $role->updated_by  = $user_id;

            if ($role->save())
            {
                $modules = Modules::select('id')->get();

                foreach($modules as $module)
                {
                    $module_id = $module->id;
                    $access_level = new AccessLevel();
                    $access_level->create     = 0;
                    $access_level->read       = 0;
                    $access_level->update     = 0;
                    $access_level->delete     = 0;
                    $access_level->role_id    = $role->id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;
                    $access_level->save();

                }
                Toastr::success("Role created successfully.","Success!");
                return redirect()->route('role_create');
            }
        }
        catch (Exception $e)
        {
            Toastr::error("Sorry something went wrong! Data cannot created successfully!","Danger!");
            return redirect()->route('role_create');
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('accesslevel::roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Role name required',
            'description.required' => 'Role description required',
        ]);

        try
        {
            $role_data = $request->all();
            $user_id = Auth::guard("admin")->user()->id;

            $role = Role::find($id);
            $role->name        = trim(strip_tags($role_data['name']));
            $role->description = trim(strip_tags($role_data['description']));
            $role->created_by  = $user_id;
            $role->updated_by  = $user_id;

            if ($role->update())
            {
                Toastr::success("Role updated successfully.","Success!");
                return redirect()->route('role_edit', ['id' => $id]);
            }
        }
        catch (Exception $e)
        {
            Toastr::success("Sorry something went wrong! Data cannot created successfully!","Danger!");
            return redirect()->route('role_edit', ['id' => $id]);
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if(count($role->admin) == 0){

           // $role->delete();

            Toastr::success("Role Deleted Successfully!","Success!");
            return redirect()->back();
        }
        else{
            Toastr::success("Role Deleted Failed!","Danger!");
            return redirect()->back();
        }

    }

}
