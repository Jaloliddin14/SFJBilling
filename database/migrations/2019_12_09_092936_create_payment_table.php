<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('abonent_id')->unsigned();
            $table->decimal('saldo_begin',15,2)->default(0);
            $table->decimal('service_nach',15,2)->default(0);
            $table->decimal('oplata',15,2)->default(0);
            $table->decimal('pererschet',15,2)->default(0);
            $table->decimal('saldo_end',15,2)->default(0);
            $table->date('period');
            $table->foreign('abonent_id')->references('id')->on('abonent');
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
        Schema::dropIfExists('payment');
    }
}
