<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceNachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_nach', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('abonent_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->date('sana_begin');
            $table->date('sana_end')->nullable();
            $table->decimal('cena',15,2);
            $table->date('doc_sana');
            $table->string('doc_nomer');
            $table->boolean('is_active');
            $table->bigInteger('user_id')->unsigned();
            $table->date('period');
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('service_nach');
    }
}
