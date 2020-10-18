<?php

namespace App\Http\Controllers;

use App\Models\Cointransfer\Cointransfer;
use App\Models\Config\Config;
use App\Models\Deposit\Userdeposit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class CointransferController extends Controller
{
#Coin Transfer page view.
    public function coinTransfer() {
        $config = Config::first();
        return view("frontend.pages.cointransfer",compact("config"));
    }

    #Store Coin Transfer
    public function storeCoinTransfer (Request $request) {

        /*Validation*/
        $this->validate($request,[
            "username" => "required",
            "transferAmount" => "required",
            "password" => "required",
        ],[
            "username.required" => "Username is required",
            "transferAmount.required" => "Transfer amount is required",
            "password.required" => "Password is required",
        ]);

        try{

            /*User check*/
            $username = strtolower(trim(strip_tags($request->username)));
            $userTo = User::where("username",$username)->first();
            if(!$userTo){
                return redirect()->back()->with('warning', "Sorry! User does not exists.");
            }

            /*Amount transfer range*/
            $config = Config::first();
            if(trim(strip_tags($request->transferAmount)) < $config->coinTransferMinimum || trim(strip_tags($request->transferAmount)) > $config->coinTransferMaximum ){
                return redirect()->back()->with('warning', "Sorry! deposit range $config->coinTransferMinimum to $config->coinTransferMaximum.");
            }

            #check old and requested new password.
            $userFrom = User::find(Auth::guard("web")->user()->id);
            if(!Hash::check(trim(strip_tags($request->password)), $userFrom->password)) {
                return redirect()->back()->with('warning', "Sorry! Your password not match.");
            }

            if($userFrom->totalBalance < 0 || $userFrom->totalRegularDepositAmount < 0 || $userFrom->totalSpecialDepositAmount < 0 || $userFrom->totalCoinReceiveAmount < 0 || $userFrom->totalSponsorAmount < 0 || $userFrom->totalProfitAmount < 0 || $userFrom->totalCoinTransferAmount < 0  || $userFrom->totalLossAmount < 0   || $userFrom->totalWithdrawAmount < 0 ){
                return redirect()->back()->with('warning', "Sorry! Account problem contact admin.");
            }

            /*Coin transfer permission*/
            $config = Config::first();
            if($config->coinTransferStatus == 0){
                return redirect()->back()->with('warning', "Sorry! Coin transfer not available right now.");
            }

            /*Check if own send own account*/
            if( $userFrom->username == $username){
                return redirect()->back()->with('warning', "Sorry! Invalid username.");
            }

            /*user balance check*/
            if($userFrom->totalBalance < trim(strip_tags($request->transferAmount))){
                return redirect()->back()->with('warning', "Sorry! Your balance is too low.");
            }

            /*user rest of balance check*/
            if(($userFrom->totalBalance - trim(strip_tags($request->transferAmount))) < $config->coinTransferMinimum ){
                return redirect()->back()->with('warning', "Sorry! After transfer balance must have $config->coinTransferMinimum coin.");
            }

            $coinTransfer = new Cointransfer();
            $coinTransfer->fromuserid = $userFrom->id;
            $coinTransfer->touserid   = $userTo->id;
            $coinTransfer->transferAmount     = trim(strip_tags($request->transferAmount));
            /*$coinTransfer->transferUserPcMac  = strtok(exec('getmac'), ' ');*/
            $coinTransfer->save();

            #Update user-form table
            $userFrom->totalCoinTransferAmount = ($userFrom->totalCoinTransferAmount + $coinTransfer->transferAmount);
            $userFrom->update();

            #Update user totalBalance
            $userFrom->totalBalance = ($userFrom->totalRegularDepositAmount + $userFrom->totalSpecialDepositAmount + $userFrom->totalCoinReceiveAmount + $userFrom->totalSponsorAmount + $userFrom->totalProfitAmount) - ($userFrom->totalCoinTransferAmount + $userFrom->totalLossAmount + $userFrom->totalWithdrawAmount);
            $userFrom->update();

            #Update user-to table
            $userTo->totalCoinReceiveAmount	 = ($userTo->totalCoinReceiveAmount + $coinTransfer->transferAmount);
            $userTo->update();

            #Update user totalBalance
            $userTo->totalBalance = ($userTo->totalRegularDepositAmount + $userTo->totalSpecialDepositAmount + $userTo->totalCoinReceiveAmount + $userTo->totalSponsorAmount + $userTo->totalProfitAmount) - ($userTo->totalCoinTransferAmount + $userTo->totalLossAmount + $userTo->totalWithdrawAmount);
            $userTo->update();

            return redirect()->back()->with('success', "Coin successfully transfer");
        }catch (Exception $e){
            return redirect()->back()->with('warning', "Something went wrong!");
        }


    }

    #Coin Transfer history page view.
    public function coinTransferHistory() {
        $coinTransferHistories = Cointransfer::with(["fromUser","toUser"])->where("fromuserid",Auth::guard("web")->user()->id)->orderBy("created_at","desc")->paginate(10);
        return view("frontend.pages.cointransferhistory",compact("coinTransferHistories"));
    }

}
