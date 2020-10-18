<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterdepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterdeposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('totalBalance')->nullable();
            $table->decimal('totalSiteDeposit')->nullable();
            $table->decimal('totalUserRegularDeposit')->nullable();
            $table->decimal('totalUserSpecialDeposit')->nullable();
            $table->decimal('totalLossToClub')->nullable();
            $table->decimal('totalLossToSponsor')->nullable();
            $table->decimal('totalLossToUser')->nullable();
            $table->decimal('totalProfitFromUser')->nullable();
            $table->decimal('totalPartialFromUser')->nullable();
            $table->decimal('totalWithdrawFromUser')->nullable();
            $table->decimal('totalWithdrawFromClub')->nullable();
            $table->decimal('totalWithdrawFromSite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masterdeposits');
    }
}
