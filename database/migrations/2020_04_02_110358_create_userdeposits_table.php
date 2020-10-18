<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserdepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userdeposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('paymentMethodType')->nullable();
            $table->string('phoneForm')->nullable();
            $table->string('phoneTo')->nullable();
            $table->decimal('depositAmount')->nullable();
            $table->string('userPcMac')->nullable();
            $table->string('userInfo')->nullable();
            $table->string('acceptedPcMac')->nullable();
            $table->string('acceptedInfo')->nullable();
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->string('depositType',50)->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('accepted_by')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userdeposits');
    }
}
