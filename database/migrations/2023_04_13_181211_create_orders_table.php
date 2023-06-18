<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('phone_code')->nullable();
            $table->string('telefon');
            $table->string('adres');
            $table->string('mesaj')->nullable();
            $table->string('kart_ismi');
            $table->string('kart_numarasi');
            $table->string('son_kullanma_tarihi');
            $table->string('cvv');
            $table->longText('json');
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
        Schema::dropIfExists('orders');
    }
}
