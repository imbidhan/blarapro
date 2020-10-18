<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slideTitle')->nullable();
            $table->text('sliderContent')->nullable();
            $table->string('slideBtnText')->nullable();
            $table->string('slideBtnLink')->nullable();
            $table->string('slideImage')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slides');
    }
}
