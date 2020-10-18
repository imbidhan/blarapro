<?php

namespace App\Providers;
use App\Models\Complain\Usercomplain;
use App\Models\Deposit\Userdeposit;
use Illuminate\Support\ServiceProvider;
use App\Models\Withdraw\Userwithdraw;
use View;
class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composer(['backend.backendMaster'], function ($view){
            $view->with('userDeposits',Userdeposit::with("userCreated")->where("status",0)->get());
            $view->with('userWithdraws',Userwithdraw::with("user")->where("status",0)->get());
            $view->with('userComplains',Usercomplain::with("user")->where("status",0)->get());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
