<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->text("common")->nullable();
            $table->string("photo")->nullable();
            $table->float("dimension")->nullable();
            $table->string("sheet")->nullable();
            $table->string("map")->nullable();
            $table->string("parcel")->nullable();
            $table->text("type")->nullable();
            $table->text("irrigation")->nullable();
            $table->text("offer")->nullable();
            $table->float("price")->nullable();
            $table->boolean("available")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lands');
    }
}
