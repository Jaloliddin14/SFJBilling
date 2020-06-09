<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionGetCena extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            DROP FUNCTION IF EXISTS `get_cena`;
            CREATE DEFINER=`root`@`localhost` FUNCTION `get_cena`(
                `id_service` integer,
                `sana` date
            )
            RETURNS decimal(15,2)
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER

            BEGIN

            DECLARE cena DEC(15,2) DEFAULT 0;

            SELECT
                DISTINCT t1.cena
            INTO cena
            FROM
                service_cena as t1
             INNER join services as t2 on sana BETWEEN t1.sana_begin and t1.sana_end
             and t1.service_id=id_service;

                RETURN cena;
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
        DB::unprepared('DROP FUNCTION `get_cena`');
    }
}
