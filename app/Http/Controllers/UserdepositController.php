<?php

namespace App\Http\Controllers;

use App\Models\Config\Bkash;
use App\Models\Config\Config;
use App\Models\Deposit\Masterdeposit;
use App\Models\Deposit\Userdeposit;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Response;
use Jenssegers\Agent\Agent;

class UserdepositController extends Controller
{
    // Function to get the client IP address or Visitor ip address
    protected function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    protected function getUserLocationInfo() {

        $agent = new Agent();
        $platform = $agent->platform();
        $version  = $agent->version($platform);
        $browser  = $agent->browser();

        $divice = "";
        if($agent->isDesktop() == 1){
            $device = "Computer";
        }else if($agent->isTablet() == 1){
            $device = "Tablet";
        }else if($agent->isMobile() == 1){
            $device = "Mobile";
        }

        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $this->get_client_ip()));
        $userLocationInfo =  'Device:' . $device.' - ';
        $userLocationInfo .=  'Operating System:' . $platform ." ". $version.' - ';
        $userLocationInfo .=  'Browser:' . $browser .' - ';
        $userLocationInfo .=  'IP Address:' . $this->get_client_ip() .' - ';
        $userLocationInfo .=  'Continent:' . $ipdat->geoplugin_continentName .' - ';
        $userLocationInfo .=  'Country: ' . $ipdat->geoplugin_countryName .' - ';
        $userLocationInfo .=  'City:' . $ipdat->geoplugin_city .' - ';
        $userLocationInfo .=  'Latitude:' . $ipdat->geoplugin_latitude .' - ';
        $userLocationInfo .=  'Longitude:' . $ipdat->geoplugin_longitude .' - ';
        $userLocationInfo .=  'Timezone:' . $ipdat->geoplugin_timezone;
        return $userLocationInfo;

    }

    #Make deposit page view.
    public function makeDeposit() {
        $config = Config::first();
        //return $config;
        return view("frontend.pages.makedeposit",compact("config"));
    }

    public function depositNumberRefresh() {
        $bkash = Bkash::select('bkashNumber')->where('status',1)->first();
        return Response::json($bkash);
    }

    #User Online Deposit
    public function userOnlineDeposit(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
            "paymentMethodType" => "required",
            "depositAmount" => "required|numeric",
            "phoneForm" => "required|string|min:11|max:11",
            "phoneTo" => "required|numeric",
            "password" => "required",
        ], [
            "paymentMethodType.required" => "Payment method type required",
            "depositAmount.required" => "Deposit amount required",
            "phoneForm.required" => "Phone number form is required",
            "phoneForm.min" => "Phone number should be 11 digit",
            "phoneForm.max" => "Phone number should be 11 digit",
            "phoneTo.required" => "Phone number to is required",
            "password.required" => "Password is required",
        ]);

        /*Find admin user here*/
        $user = User::find(Auth::guard("web")->user()->id);

        try{
            $config = Config::first();
            if(trim(strip_tags($request->depositAmount)) < $config->depositMinimum || trim(strip_tags($request->depositAmount)) > $config->depositMaximum ){
                return redirect()->back()->with("warning", "Sorry! deposit range $config->depositMinimum to $config->depositMaximum!");
            }
            #check old and requested new password.
            if(Hash::check($request->password, $user->password)) {

                $userDeposit = new Userdeposit();
                $userDeposit->user_id = $user->id;
                $userDeposit->paymentMethodType = trim(strip_tags($request->paymentMethodType));
                $userDeposit->phoneForm = trim(strip_tags($request->phoneForm));
                $userDeposit->phoneTo = trim(strip_tags($request->phoneTo));
                $userDeposit->depositAmount = trim(strip_tags($request->depositAmount));
                /*$userDeposit->userPcMac = strtok(exec('getmac'), ' ');*/
                $userDeposit->userInfo = $this->getUserLocationInfo();
                $userDeposit->save();

                //return redirect()->back()->with("success", "Your coin request submitted, Please wait for sometime");
                return redirect()->route("deposit_history")->with("success", "Your coin request submitted, Please wait for sometime");

            } else{
                return redirect()->back()->with("warning", "Sorry! Your password not match!");
            }
        }catch (Exception $e){
            return redirect()->back()->with("warning", "Something went wrong!");
        }
    }

    #Approve online user
    public function userOnlineDepositRequestView() {
        $userDeposits = Userdeposit::with("userCreated")->where("status",0)->orderBy("created_at","ASC")->get();
        return view("deposit::onlineUser.index",compact('userDeposits'));
    }

    #Approve online user
    public function approveUserOnlineDepositRequest(Request $request ,$id) {

        if(empty(trim(strip_tags($request->depositType)))){
            Toastr::error("Sorry! please select deposit type", "Danger!");
            return redirect()->back();
        }

        try {
            $mainSiteDeposit = Masterdeposit::first();
            $userDeposit = Userdeposit::where(["id"=>$id,"status"=>0])->first();

            if ($mainSiteDeposit->totalSiteDeposit > $userDeposit->depositAmount) { #check $userDeposit is smaller then $totalSiteDeposit balance
                #This deposit user coin request accept
                /*$userDeposit->acceptedPcMac = strtok(exec('getmac'), ' ');*/
                $userDeposit->acceptedInfo = $this->getUserLocationInfo();
                $userDeposit->accepted_by = Auth::guard("admin")->user()->id;
                $userDeposit->depositType = trim(strip_tags($request->depositType));
                if(trim(strip_tags($request->depositType)) == "unpaid"){
                    $userDeposit->status = 2;
                }else{
                    $userDeposit->status = 1;
                }
                $userDeposit->update();

                if(trim(strip_tags($request->depositType)) == "getmoney"){
                    #MasterDeposit update
                    $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit - $userDeposit->depositAmount);
                    $mainSiteDeposit->totalUserRegularDeposit = ($mainSiteDeposit->totalUserRegularDeposit + $userDeposit->depositAmount);
                    $mainSiteDeposit->update();

                    #Update user depositAmount
                    $user = User::where("id", $userDeposit->user_id)->first();
                    $user->totalRegularDepositAmount = ($user->totalRegularDepositAmount + $userDeposit->depositAmount);
                    $user->update();

                    #Update user totalBalance
                    $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                    $user->update();

                }

                if(trim(strip_tags($request->depositType)) == "cointocoin"){
                    #MasterDeposit update
                    $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit - $userDeposit->depositAmount);
                    $mainSiteDeposit->totalUserSpecialDeposit = ($mainSiteDeposit->totalUserSpecialDeposit + $userDeposit->depositAmount);
                    $mainSiteDeposit->update();

                    #Update user depositAmount
                    $user = User::where("id", $userDeposit->user_id)->first();
                    $user->totalSpecialDepositAmount	 = ($user->totalSpecialDepositAmount + $userDeposit->depositAmount);
                    $user->update();

                    #Update user totalBalance
                    $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                    $user->update();
                }

                if(trim(strip_tags($request->depositType)) == "unpaid"){
                    Toastr::success("Unpaid payment", "Success!");
                    return redirect()->back();
                }

                Toastr::success("Coin transfer to user account", "Success!");
                return redirect()->back();

            } else {

                Toastr::error("Sorry! User request amount is bigger than main balance, So Increase site deposit balance", "Danger!");
                return redirect()->back();

            }
        }catch (Exception $e){
            Toastr::error("Sorry! Something went wrong", "Danger!");
            return redirect()->back();
        }
    }

    #Deposit History page view.
    public function depositHistory() {

        $userDeposits = Userdeposit::with("userCreated")
            ->where("user_id",Auth::guard("web")->user()->id)
            ->orderBy("created_at","desc")->paginate(10);
        return view("frontend.pages.deposithistory",compact("userDeposits"));
    }

    #Get Money
    public function getMoneyDeposit() {
        $getMoneys = Userdeposit::with("userCreated","acceptedBy")->where("status",1)
            ->where("depositType","getmoney")
            ->orderBy("created_at","DESC")
            ->get();
        return view("deposit::onlineUser.getmoney",compact('getMoneys'));
    }


    #Accepted user deposit refund.
        public function acceptedUserDepositRefundForGetMoney($id) {
        try {

            $mainSiteDeposit = Masterdeposit::first();

            $userDepositRefund = Userdeposit::where(["id"=>$id,"depositType"=>"getmoney","status"=>1])->first();
            $user = User::where("id", $userDepositRefund->user_id)->first();
            if($user->totalRegularDepositAmount >= $userDepositRefund->depositAmount) {

                $userDepositRefund->acceptedInfo = null;
                $userDepositRefund->accepted_by = null;
                $userDepositRefund->depositType = null;
                $userDepositRefund->status = 0;
                $userDepositRefund->update();

                #MasterDeposit update
                $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit + $userDepositRefund->depositAmount);
                $mainSiteDeposit->totalUserRegularDeposit = ($mainSiteDeposit->totalUserRegularDeposit - $userDepositRefund->depositAmount);
                $mainSiteDeposit->update();

                #Update user depositAmount

                $user->totalRegularDepositAmount = ($user->totalRegularDepositAmount - $userDepositRefund->depositAmount);
                $user->update();

                #Update user totalBalance
                $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                $user->update();

                Toastr::success("Deposit refund successfully.", "Success!");
                return redirect()->back();
            }else{
                Toastr::error("Your regular deposit balance is lower for this action.", "Danger!");
                return redirect()->back();
            }

        }catch (Exception $e){
            Toastr::error("Sorry! Something went wrong", "Danger!");
            return redirect()->back();
        }
    }


    #Get Coin to coin
    public function getCoinToCoinDeposit() {
        $getCoinToCoins = Userdeposit::with("userCreated","acceptedBy")->where("status",1)
            ->where("depositType","cointocoin")
            ->orderBy("created_at","DESC")
            ->get();
        return view("deposit::onlineUser.getcointocoin",compact('getCoinToCoins'));
    }

    #Accepted user deposit refund coin to coin
    public function acceptedUserDepositRefundForCoinToCoin($id) {
        //return $id;
        try {

            $mainSiteDeposit = Masterdeposit::first();

            $userDepositRefund = Userdeposit::where(["id"=>$id,"depositType"=>"cointocoin","status"=>1])->first();
            $user = User::where("id", $userDepositRefund->user_id)->first();
            if($user->totalSpecialDepositAmount >= $userDepositRefund->depositAmount) {
                $userDepositRefund->acceptedInfo = null;
                $userDepositRefund->accepted_by = null;
                $userDepositRefund->depositType = null;
                $userDepositRefund->status = 0;
                $userDepositRefund->update();

                #MasterDeposit update
                $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit + $userDepositRefund->depositAmount);
                $mainSiteDeposit->totalUserSpecialDeposit = ($mainSiteDeposit->totalUserSpecialDeposit - $userDepositRefund->depositAmount);
                $mainSiteDeposit->update();

                #Update user depositAmount
                $user = User::where("id", $userDepositRefund->user_id)->first();
                $user->totalSpecialDepositAmount = ($user->totalSpecialDepositAmount - $userDepositRefund->depositAmount);
                $user->update();

                #Update user totalBalance
                $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                $user->update();


                Toastr::success("Deposit coin refund successfully.", "Success!");
                return redirect()->back();
            }else{
                Toastr::error("Your coin to coin balance is lower for this action.", "Danger!");
                return redirect()->back();
            }
        }catch (Exception $e){
            Toastr::error("Sorry! Something went wrong", "Danger!");
            return redirect()->back();
        }
    }

    #Unpaid
    public function getUnpaidDeposit() {
        $unpaids = Userdeposit::with("userCreated","acceptedBy")->where("status",2)
            ->where("depositType","unpaid")
            ->orderBy("created_at","DESC")
            ->get();
        return view("deposit::onlineUser.unpaid",compact('unpaids'));
    }

    #Unpaid Deposit Back
    public function acceptedUserDepositRefundForUnpaid($id) {
        try {

            $mainSiteDeposit = Masterdeposit::first();

            $userDepositRefund = Userdeposit::where(["id"=>$id,"depositType"=>"unpaid","status"=>2])->first();
            $userDepositRefund->acceptedInfo = null;
            $userDepositRefund->accepted_by = null;
            $userDepositRefund->depositType = null;
            $userDepositRefund->status = 0;
            $userDepositRefund->update();

            Toastr::success("Unpaid return successfully.", "Success!");
            return redirect()->back();

        }catch (Exception $e) {
            Toastr::error("Sorry! Something went wrong", "Danger!");
            return redirect()->back();
        }
    }
}
