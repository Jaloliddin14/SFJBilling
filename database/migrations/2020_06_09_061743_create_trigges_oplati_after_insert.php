<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggesOplatiAfterInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` TRIGGER `oplati_after_insert` AFTER INSERT ON `oplati` FOR EACH ROW BEGIN
	            UPDATE payment SET oplata=oplata+NEW.oplata
	                WHERE abonent_id=NEW.abonent_id AND period IN ((SELECT tekoy FROM syssana));

            	UPDATE payment SET saldo_end=saldo_begin-service_nach+oplata
	                WHERE abonent_id=NEW.abonent_id AND period IN ((SELECT tekoy FROM syssana));

            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `oplati_after_insert`');
    }
}
