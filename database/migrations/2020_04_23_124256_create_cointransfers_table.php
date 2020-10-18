<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCointransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cointransfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("fromuserid")->nullable();
            $table->unsignedBigInteger("touserid")->nullable();
            $table->decimal("transferAmount")->nullable();
            $table->string("transferUserPcMac")->nullable();
            $table->boolean("status")->default(true);
            $table->timestamps();
            $table->foreign('fromuserid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('touserid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cointransfers');
    }
}
