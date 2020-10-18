<?php

namespace App\Modules\Config\Http\Controllers;

use App\Models\Config\Bkash;
use App\Models\Config\Config;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BkashController extends Controller
{
    #View bkash
    public function index() {
        $bkashs = Bkash::whereIn("status",[0,1])->get();
        return view("config::bkash.index",compact("bkashs"));
    }

    #Created bkash
    public function create() {
        return view("config::bkash.create");
    }

    #Store bkash
    public function store(Request $request) {

        $this->validate($request,[
            "bkashNumber" => "required"
        ]);

        $bkash = new Bkash();
        $bkash->bkashNumber = trim(strip_tags($request->bkashNumber));
        /*$bkash->pcMac = strtok(exec('getmac'), ' ');*/
        $bkash->created_by = Auth::guard("admin")->user()->id;
        $bkash->save();

        Toastr::success("Number Added successfully","Success!");
        return redirect()->back();
    }

    #Edit Config
    public function edit($id) {
        $bkash = Bkash::find($id);
        return view("config::bkash.edit",compact("bkash"));
    }

    #Update Config
    public function update(Request $request , $id) {

        $this->validate($request,[
            "bkashNumber" => "required",
            "status" => "required",
        ]);

        $bkash = Bkash::find($id);
        $bkash->bkashNumber = trim(strip_tags($request->bkashNumber));
        $bkash->status = trim(strip_tags($request->status));
        $bkash->updated_by = Auth::guard("admin")->user()->id;
        $bkash->updated_at = Carbon::now();
        $bkash->save();

        Toastr::success("Bkash number update successfully","Success!");
        return redirect()->back();

    }

    #Bkash delete
    public function destroy ($id) {
        $bkash = Bkash::find($id);
        $bkash->status = 2;
        $bkash->save();
        Toastr::success("Bkash number deleted successfully","Success!");
        return redirect()->back();
    }
}
