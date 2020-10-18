<?php

namespace App\Http\Controllers;

use App\Models\Complain\Usercomplain;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserComplainController extends Controller
{
    #User complain view
    public function userComplain(){
        return view("frontend.pages.userComplain");
    }

    #User complain submit
    public function userComplainStore(Request $request){
        //return $request->all();
        $this->validate($request, [
            "username" => "required",
            "phone" => "required|string|min:11|max:11",
            "message" => "required",
            "password" => "required",
        ], [
            "username.required" => "Username is required",
            "phone.required" => "Phone number is required",
            "phone.min" => "Phone number should be 11 digit",
            "phone.max" => "Phone number should be 11 digit",
            "message.required" => "Message is required",
            "password.required" => "Password is required",
        ]);

        try {
            $user = User::find(Auth::guard("web")->user()->id);
            if(Hash::check($request->password, $user->password)) {
                if ($request->file('image')) {

                    $fileInfo = $request->file('image');
                    $imageExt = strtolower($fileInfo->getClientOriginalExtension());
                    $size = $fileInfo->getSize();
                    $kb = $size / 1024;

                    if (in_array($imageExt,['jpg','png']) == false) {
                        return redirect()->back()->with("warning", "Opps! Upload only jpg , png format");
                    }

                    if ($kb > 200) {
                        return redirect()->back()->with("warning", "Opps! file size less then 200 KB.");
                    }

                    $uniqueName = "thump_" . time() . rand() . "." . strtolower($imageExt);
                    $folderName = "backend/uploads/complain/";
                    $fileInfo->move($folderName, $uniqueName);
                    $imageDbPath = $folderName . $uniqueName;
                }
                #Submit user complain
                $userComplain = new Usercomplain();
                $userComplain->user_id = $user->id;
                $userComplain->phone = strip_tags(trim($request->phone));
                if ($request->file('image')) {
                    $userComplain->image  = $imageDbPath;
                }
                $userComplain->message = strip_tags(trim($request->message));
                $userComplain->save();
                return redirect()->back()->with("success", "Complain submit successfully.");
            }else{
                return redirect()->back()->with("warning", "Sorry! Your password not match!");
            }
        }catch (Exception $e){
            return redirect()->back()->with("warning", "Sorry! Something went wrong.");
        }
    }

    #New complain form user
    public function newComplainFromUser() {
        $complains = DB::table('usercomplains')
            ->leftJoin("users","users.id","=", "usercomplains.user_id")
            ->leftJoin("admins","admins.id","=", "usercomplains.complainAcceptedBy")
            ->where("usercomplains.status",0)
            ->select("usercomplains.*","users.username","admins.username as adminName")
            ->get();

        return view("backend.pages.complain.newcomplain",compact("complains"));
    }

    #complain accept
    public function complainAccept($id){

        try {
            $complain = Usercomplain::where("id",$id)->where("status",0)->first();
            $complain->status = 1;
            $complain->complainAcceptedBy = Auth::guard("admin")->user()->id;
            $complain->update();
            Toastr::success("Complain seen","Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Somthing went wrong","Error!");
            return redirect()->back();
        }
    }

    #Get complain user
    public function getUserComplain() {
        $complains = DB::table('usercomplains')
            ->leftJoin("users","users.id","=", "usercomplains.user_id")
            ->leftJoin("admins","admins.id","=", "usercomplains.complainAcceptedBy")
            ->where("usercomplains.status",1)
            ->select("usercomplains.*","users.username","admins.username as adminName")
            ->get();
        return view("backend.pages.complain.complainlist",compact("complains"));
    }

}
