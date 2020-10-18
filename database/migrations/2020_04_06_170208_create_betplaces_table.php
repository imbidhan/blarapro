<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betplaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('betdetail_id')->nullable();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->unsignedBigInteger('betoption_id')->nullable();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->decimal('clubRate')->nullable();
            $table->decimal('clubGet')->nullable();
            $table->string('sponsorName',100)->nullable();
            $table->decimal('sponsorRate')->nullable();
            $table->decimal('sponsorGet')->nullable();
            $table->decimal('betAmount')->nullable();
            $table->decimal('betRate')->nullable();
            $table->decimal('betProfit')->default(0.00);
            $table->decimal('betLost')->default(0.00);
            $table->decimal('partialLost')->default(0.00);
            $table->decimal('partialRate')->default(0.00);
            $table->string('winLost',50)->nullable();
            $table->boolean('status')->default(false);
            $table->string('pcMac')->nullable();
            $table->unsignedBigInteger('accepted_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('club_id')->references('id')->on('clubs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('match_id')->references('id')->on('matches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('betdetail_id')->references('id')->on('betdetails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('betdetails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('betoption_id')->references('id')->on('betoptions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('accepted_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('betplaces');
    }
}
