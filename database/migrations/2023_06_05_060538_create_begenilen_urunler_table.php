<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBegenilenUrunlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('begenilen_urunler', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('urun_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('urun_id')->references('id')->on('kitaplars')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('begenilen_urunler');
    }
}
