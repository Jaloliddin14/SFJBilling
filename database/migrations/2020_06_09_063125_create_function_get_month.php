<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionGetMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            DROP FUNCTION IF EXISTS `get_month`;
            CREATE DEFINER=`root`@`localhost` FUNCTION `get_month`(
                `d1` date,
                `d2` date
            )
            RETURNS int(11)
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER

            BEGIN

                DECLARE cnt Int DEFAULT 0;
                select (Month(d2) - Month(d1) + 1 + (Year(d2) - Year(d1) ) * 12  ) as cnt
                INTo cnt
                from syssana;
                RETURN cnt;
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
        DB::unprepared('DROP FUNCTION `get_month`');
    }
}
