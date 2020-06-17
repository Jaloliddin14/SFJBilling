<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerAbonentAfterUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` TRIGGER `abonent_after_update` AFTER UPDATE ON `abonent` FOR EACH ROW BEGIN
            INSERT INTO arxiv_abonent(abonent_id,	pass_fio, pass_seriya, pass_nomer, pass_iib,pass_sana_birth,pass_sana_get,pass_sana_exp,add_street_id,add_dom,add_korpus,add_podyezd,add_kvartira,sana_add,dogovor_sana,dogovor_nomer,is_active,phone,email,slug)
            VALUES(OLD.id,OLD.pass_fio,OLD.pass_seriya,OLD.pass_nomer,OLD.pass_iib,OLD.pass_sana_birth,OLD.pass_sana_get,OLD.pass_sana_exp,OLD.add_street_id,OLD.add_dom,OLD.add_korpus,OLD.add_podyezd,OLD.add_kvartira,OLD.sana_add,OLD.dogovor_sana,OLD.dogovor_nomer,OLD.is_active,OLD.phone,OLD.email,OLD.slug);
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
        DB::unprepared('DROP TRIGGER `abonent_after_update`');
    }


}
