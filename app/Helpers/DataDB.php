<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

/**
 * DataDB helper
 */
class DataDB
{
    public static function period()
    {
        return DB::table('syssana')->first('tekoy');
    }

    public static function abonents($slug)
    {
        return DB::table('abonent')->join('street', 'add_street_id', 'street.id')->
        select('abonent.*', 'street.street_name')->
        where('slug', $slug)->first();
    }

    public static function abonentarxiv($slug)
    {
        return DB::table('arxiv_abonent')->join('street', 'add_street_id', 'street.id')->
        select('arxiv_abonent.*', 'street.street_name')->
        where('slug', $slug)->get();
    }


    public static function oplati($abonent_id)
    {
        return DB::table('oplati')->join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        join('users', 'user_id', 'users.id')->
        select('oplati.*', 'oplata_tip.oplata_tip_name', 'users.name')->
        where('abonent_id', $abonent_id)->orderByDesc('sana_add')->get();
    }

    public static function uslugi($abonent_id)
    {
        return DB::table('service_nach')->
        join('services', 'service_id', 'services.id')->
        join('users', 'user_id', 'users.id')->
        select('service_nach.*', 'users.name', 'services.service_name','services.monthly')->
        where('abonent_id', $abonent_id)->where('period',DataDB::period()->tekoy)->
        orderByDesc('id')->get();
    }


    public static function payment($abonent_id)
    {
        return DB::table('payment')->where('abonent_id', $abonent_id)
            ->where('period', DataDB::period()->tekoy)->first();
    }

    public static function payments($abonent_id)
    {
        return DB::table('payment')->where('abonent_id', $abonent_id)->get();
    }

}
