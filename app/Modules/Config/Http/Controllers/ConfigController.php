<?php

namespace App\Modules\Config\Http\Controllers;

use App\Models\Config\Config;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    #View config
    public function index() {
        $config = Config::first();
        return view("config::config.index",compact("config"));
    }

    #Edit Config
    public function edit($id) {
        $config = Config::find($id);
        return view("config::config.edit",compact("config"));
    }

    #Update Config
    public function update(Request $request , $id) {
        $this->validate($request,[
            "siteNotice" => "required",
            "depositMsg" => "required",
            "betMinimum" => "required",
            "betMaximum" => "required",
            "depositMinimum" => "required",
            "depositMaximum" => "required",
            "coinTransferMinimum" => "required",
            "coinTransferMaximum" => "required",
            "userWithdrawMinimum" => "required",
            "userWithdrawMaximum" => "required",
            "clubRate" => "required",
            "sponsorRate" => "required",
            "partialOne" => "required",
            "partialTwo" => "required",
            "betOnOff" => "required",
            "coinTransferStatus" => "required",
            "userWithdrawStatus" => "required",
            "clubWithdrawStatus" => "required",
        ]);

        $config = Config::find($id);
        $config->siteNotice = trim(strip_tags($request->siteNotice));
        $config->depositMsg = trim(strip_tags($request->depositMsg));
        $config->betMinimum = trim(strip_tags($request->betMinimum));
        $config->betMaximum = trim(strip_tags($request->betMaximum));
        $config->depositMinimum = trim(strip_tags($request->depositMinimum));
        $config->depositMaximum = trim(strip_tags($request->depositMaximum));
        $config->betOnOff = trim(strip_tags($request->betOnOff));
        $config->coinTransferMinimum = trim(strip_tags($request->coinTransferMinimum));
        $config->coinTransferMaximum = trim(strip_tags($request->coinTransferMaximum));
        $config->userWithdrawMinimum = trim(strip_tags($request->userWithdrawMinimum));
        $config->userWithdrawMaximum = trim(strip_tags($request->userWithdrawMaximum));
        $config->clubRate = trim(strip_tags($request->clubRate));
        $config->sponsorRate = trim(strip_tags($request->sponsorRate));
        $config->partialOne = trim(strip_tags($request->partialOne));
        $config->partialTwo = trim(strip_tags($request->partialTwo));
        $config->coinTransferStatus = trim(strip_tags($request->coinTransferStatus));
        $config->userWithdrawStatus = trim(strip_tags($request->userWithdrawStatus));
        $config->clubWithdrawStatus = trim(strip_tags($request->clubWithdrawStatus));
        $config->updated_at = Carbon::now();
        $config->save();

        Toastr::success("Config update successfully","Success!");
        return redirect()->back();

    }
}
