<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pass_fio');
            $table->string('pass_seriya',2)->nullable();
            $table->string('pass_nomer',7)->nullable();
            $table->string('pass_iib')->nullable();
            $table->date('pass_sana_birth')->nullable();
            $table->date('pass_sana_get')->nullable();
            $table->date('pass_sana_exp')->nullable();
            $table->bigInteger('add_street_id')->unsigned();
            $table->string('add_dom');
            $table->string('add_korpus');
            $table->string('add_podyezd');
            $table->string('add_kvartira');
            $table->dateTime('sana_add');
            $table->date('dogovor_sana');
            $table->string('dogovor_nomer');
            $table->string('is_active');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->foreign('add_street_id')->references('id')->on('street');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonent');
    }
}
