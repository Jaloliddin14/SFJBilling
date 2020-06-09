<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggesAbonentAfterInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` TRIGGER `abonent_after_insert` AFTER INSERT ON `abonent` FOR EACH ROW BEGIN
	            INSERT INTO payment(abonent_id,period) VALUES(NEW.id,(SELECT tekoy FROM syssana));
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
        DB::unprepared('DROP TRIGGER `abonent_after_insert`');
    }
}
