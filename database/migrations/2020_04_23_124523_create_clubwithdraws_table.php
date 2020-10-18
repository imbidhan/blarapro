<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubwithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubwithdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("club_id")->nullable();
            $table->decimal("withdrawAmount")->nullable();
            $table->string("withdrawUserPcMac")->nullable();
            $table->timestamp("withdrawReturnDateTime")->nullable();
            $table->string("withdrawType")->nullable(); #regular or special
            $table->unsignedBigInteger("withdrawAcceptedBy")->nullable();
            $table->string("withdrawAcceptedPcMac")->nullable();
            $table->boolean("status")->default(false);
            $table->timestamps();
            $table->foreign('club_id')->references('id')->on('clubs')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('clubwithdraws');
    }
}
