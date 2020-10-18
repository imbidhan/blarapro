<?php

namespace App\Modules\Deposit\Http\Controllers;

use App\Models\Deposit\Masterdeposit;
use App\Models\Withdraw\Masterwithdraw;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MasterwithdrawController extends Controller
{
    #Withdraw list view
    public function index () {
        $masterWithdraws = Masterwithdraw::where("status",1)->get();
        return view("deposit::masterwithdraw.index",compact("masterWithdraws"));
    }

    #Withdraw create view
    public function create () {
        return view("deposit::masterwithdraw.create");
    }

    #Withdraw create view
    public function store (Request $request) {

        $this->validate($request,[
            "withdrawAmount" => "required|numeric"
        ],[
            "withdrawAmount.required" => "withdraw amount is required.",
            "withdrawAmount.numeric" => "withdraw amount only numeric."
        ]);

        try {
            $masterWithdraw = new Masterwithdraw();
            $masterWithdraw->withdrawAmount = trim(strip_tags($request->withdrawAmount));
            /*$masterWithdraw->withdrawUserPcMac = strtok(exec('getmac'), ' ');*/
            $masterWithdraw->created_by = Auth::guard("admin")->user()->id;
            $masterWithdraw->save();

            #Update main balance
            $mainSiteDeposit = Masterdeposit::first();
            //return $mainSiteDeposit;
            $mainSiteDeposit->totalWithdrawFromSite = ($mainSiteDeposit->totalWithdrawFromSite + $masterWithdraw->withdrawAmount);
            $mainSiteDeposit->update();

            Toastr::success("Master withdraw successfully","Success!");
            return redirect()->back();

        }catch (Exception $e){
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();
        }
    }
}
