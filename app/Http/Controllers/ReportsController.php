<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getsaldooborot(Request $request)
    {

        $payments = DB::table('payment')->join('abonent', 'abonent_id', 'abonent.id')->
        select('payment.*', 'abonent.pass_fio')->
        where('period', $request->period)->orderByDesc('pass_fio')->get();
        //ddd($payments);

        return view('Billing.reports.saldooborot', compact('payments'));
    }

}
