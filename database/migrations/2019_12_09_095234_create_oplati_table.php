<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOplatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oplati', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('abonent_id')->unsigned();
            $table->dateTime('doc_sana');
            $table->string('doc_nomer');
            $table->dateTime('sana_add');
            $table->decimal('oplata',15,2);
            $table->bigInteger('oplata_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('oplata_id')->references('id')->on('oplata_tip');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('oplati');
    }
}
