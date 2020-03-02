<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ConfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getekoy()
    {
        $period = DB::table('syssana')->first('tekoy');
        return $period->tekoy;
    }

    public static function geteperiod()
    {
        $period = DB::select('select distinct period from payment order by period desc');
        //ddd($period);
        return $period;
    }


}
