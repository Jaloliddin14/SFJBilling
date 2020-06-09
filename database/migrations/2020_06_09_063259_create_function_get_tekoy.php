<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionGetTekoy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            DROP FUNCTION IF EXISTS `get_tekoy`;
            CREATE DEFINER=`root`@`localhost` FUNCTION `get_tekoy`()
            RETURNS date
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER

            BEGIN
                DECLARE sana date;
                select tekoy into sana from syssana;
                RETURN sana;
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
        DB::unprepared('DROP FUNCTION `get_tekoy`');
    }
}
