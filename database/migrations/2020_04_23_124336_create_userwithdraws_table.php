<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserwithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userwithdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id")->nullable();
            $table->decimal("withdrawAmount")->nullable();
            $table->string("withdrawNumber")->nullable();
            $table->string("withdrawPaymentType")->nullable();
            $table->string("withdrawUserPcMac")->nullable();
            $table->timestamp("withdrawReturnDateTime")->nullable();
            $table->unsignedBigInteger("withdrawAcceptedBy")->nullable();
            $table->string("withdrawAcceptedPcMac")->nullable();
            $table->string("reference",100)->nullable();
            $table->boolean("status")->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('withdrawAcceptedBy')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userwithdraws');
    }
}
