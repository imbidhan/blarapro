<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('siteNotice')->nullable();
            $table->text('depositMsg')->nullable();
            $table->integer('betMinimum')->nullable();
            $table->integer('betMaximum')->nullable();
            $table->boolean("betOnOff")->default(false);
            $table->integer('depositMinimum')->nullable();
            $table->integer('depositMaximum')->nullable();
            $table->integer('coinTransferMinimum')->nullable();
            $table->integer('coinTransferMaximum')->nullable();
            $table->integer('userWithdrawMinimum')->nullable();
            $table->integer('userWithdrawMaximum')->nullable();
            $table->decimal("clubRate")->nullable();
            $table->decimal("sponsorRate")->nullable();
            $table->decimal("partialOne")->nullable();
            $table->decimal("partialTwo")->nullable();
            $table->boolean("coinTransferStatus")->default(false);
            $table->boolean('userWithdrawStatus')->default(false);
            $table->boolean('clubWithdrawStatus')->default(false);
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
        Schema::dropIfExists('configs');
    }
}
