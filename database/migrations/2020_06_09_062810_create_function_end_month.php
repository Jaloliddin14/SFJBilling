<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionEndMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            DROP FUNCTION IF EXISTS `end_month`;
            CREATE DEFINER=`root`@`localhost` FUNCTION `end_month`()
            RETURNS varchar(25) CHARSET utf8mb4
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER

            BEGIN
            DECLARE check_its VARCHAR(25);

            /* 1 Перерасчитать ОПЛАТУ */
                UPDATE payment pm INNER JOIN (
                    SELECT	oplati.abonent_id, sum( oplati.oplata ) AS pul 	FROM
                    oplati 	WHERE	oplati.period = ( SELECT tekoy FROM syssana )
                    AND oplati.doc_sana < last_day((SELECT tekoy FROM	syssana ))
                    GROUP BY 	oplati.abonent_id ) sel ON pm.abonent_id = sel.abonent_id
                    SET pm.oplata = sel.pul WHERE	pm.period = ( SELECT tekoy FROM syssana );

            /* 2 Перерасчитать НАЧИСЛЕНИЕ */
                UPDATE payment pm INNER JOIN (SELECT service_nach.abonent_id,
                    sum( service_nach.cena ) as pul	FROM service_nach
                    WHERE service_nach.period = ( SELECT tekoy FROM syssana )
                    GROUP BY service_nach.abonent_id) sel on pm.abonent_id=sel.abonent_id
                    set pm.service_nach = sel.pul
                    where pm.period = ( SELECT tekoy FROM syssana );

            /* 3 Перерасчитать САЛЬДО НА КОНЕЦ */
                UPDATE payment SET saldo_end=saldo_begin-service_nach+oplata
                    WHERE period IN (SELECT tekoy FROM syssana);

            /* 4 ИЗМЕНИТЬ МЕСЯЦ */
                update syssana set tekoy = DATE_ADD(tekoy,INTERVAL 1 MONTH);

            /* 5 Создать новый месяц В Payment */
                insert into payment(abonent_id,saldo_begin,service_nach,oplata,pererschet,saldo_end,period)
                    select abonent_id,saldo_end,0,0,0,0,(select tekoy from syssana)
                    from payment where period = (select DATE_ADD(tekoy,INTERVAL -1 MONTH) from syssana);

            /* 6 Перекидать ОПЛАТУ и ЕЖЕМЕСЯЧНЫЕ УСЛУГИ на новый месяц */
                update oplati set period=(select tekoy from syssana) where doc_sana>=(select tekoy from syssana);
                insert into service_nach(abonent_id, service_id, sana_begin, sana_end, cena, doc_sana, doc_nomer, is_active, user_id, period, created_at)
                    Select abonent_id, service_id, sana_begin, sana_end, get_cena(service_id,get_tekoy()) as cena, doc_sana, doc_nomer, is_active, user_id, get_tekoy() as period, now()
                        from service_nach
                        where service_id in (SELECT id FROM services where monthly=1) and sana_end is null and period = (select DATE_ADD(tekoy,INTERVAL -1 MONTH) from syssana);


            /* 7 Перерасчитать ОПЛАТУ */
                UPDATE payment pm INNER JOIN (
                    SELECT	oplati.abonent_id, sum( oplati.oplata ) AS pul 	FROM
                    oplati 	WHERE	oplati.period = ( SELECT tekoy FROM syssana )
                    AND oplati.doc_sana < last_day((SELECT tekoy FROM	syssana ))
                    GROUP BY 	oplati.abonent_id ) sel ON pm.abonent_id = sel.abonent_id
                    SET pm.oplata = sel.pul WHERE	pm.period = ( SELECT tekoy FROM syssana );

            /* 7 Перерасчитать САЛЬДО НА КОНЕЦ */
                UPDATE payment SET saldo_end=saldo_begin-service_nach+oplata
                    WHERE period IN (SELECT tekoy FROM syssana);



                set check_its = \'OK\';

                RETURN check_its;
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
        DB::unprepared('DROP FUNCTION `end_month`');
    }
}
