<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('club_id')->nullable();
            $table->string('name')->nullable();
            $table->string('username',190)->unique();
            $table->string('email',190)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('sponsorName',100)->nullable();
            $table->string('phone',190)->nullable();
            $table->string('country',190)->nullable();
            $table->decimal('totalBalance')->default(0.00);
            $table->decimal('totalRegularDepositAmount')->default(0.00);
            $table->decimal('totalSpecialDepositAmount')->default(0.00);
            $table->decimal('totalCoinReceiveAmount')->default(0.00);
            $table->decimal('totalSponsorAmount')->default(0.00);
            $table->decimal('totalProfitAmount')->default(0.00);
            $table->decimal('totalCoinTransferAmount')->default(0.00);
            $table->decimal('totalLossAmount')->default(0.00);
            $table->decimal('totalWithdrawAmount')->default(0.00);
            $table->string('pcMac')->nullable();
            $table->string('userInfo')->nullable();
            $table->rememberToken();
            $table->boolean('status')->default(true);
            $table->timestamps();
            //$table->foreign('club_id')->references('id')->on('clubs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
