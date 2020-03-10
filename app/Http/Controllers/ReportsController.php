<?php

namespace App\Http\Controllers;

use App\Exports\ReestrnachOtchetExport;
use App\Exports\ReestroplatOtchetExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\OtchetExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //111///////////////////////////////////////////////////////////////////////////////////////////+
    public static function getsaldooborot(Request $request)
    {

        $payments = DB::table('payment')->join('abonent', 'abonent_id', 'abonent.id')->
        select('payment.*', 'abonent.pass_fio')->
        where('period', $request->period)->orderByDesc('pass_fio')->get();
        //ddd($payments);
        $periodex = $request->period;

        return view('Billing.reports.saldooborot', compact('payments', 'periodex'));
    }

    public static function getexcelsaldooborot(Request $request)
    {
        return Excel::download(new OtchetExport($request->periodex), 'Saldooborot.xlsx');
    }

    //22///////////////////////////////////////////////////////////////////////////////////////////////////+
    public static function getreestroplat(Request $request)
    {
        $periodot = $request->sana_ot;
        $perioddo = $request->sana_do;
        $oplata = DB::table('oplati')->join('abonent', 'abonent_id', 'abonent.id')->
        join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        join('users', 'user_id', 'users.id')->
        select('oplati.*', 'abonent.pass_fio', 'oplata_tip.oplata_tip_name', 'users.name')->
        whereBetween('oplati.sana_add', [$periodot, $perioddo])->orderBy('id')->get();
        //ddd($oplata);


        return view('Billing.reports.reestroplat', compact('oplata', 'periodot', 'perioddo'));
    }

    public static function getexcelreestroplat(Request $request)
    {
        return Excel::download(new ReestroplatOtchetExport($request->periodot, $request->perioddo), 'ReestrOplat.xlsx');
    }

    //33///////////////////////////////////////////////////////////////////////////////////////////////////+
    public static function getreestrnach(Request $request)
    {

        $payments = DB::table('service_nach')->join('abonent', 'abonent_id', 'abonent.id')->
        join('services', 'service_id', 'services.id')->
        select('service_nach.*', 'abonent.pass_fio','services.service_name')->
        where('period', $request->period)->orderByDesc('pass_fio')->get();
        //ddd($payments);
        $periodex = $request->period;

        return view('Billing.reports.reestrnach', compact('payments', 'periodex'));
    }

    public static function getexcelreestrnach(Request $request)
    {
        return Excel::download(new ReestrnachOtchetExport($request->periodex), 'ReestNachisleniy.xlsx');
    }

    //44///////////////////////////////////////////////////////////////////////////////////////////////////
    public static function getpostupleniye(Request $request)
    {

        $payments = DB::table('payment')->join('abonent', 'abonent_id', 'abonent.id')->
        select('payment.*', 'abonent.pass_fio')->
        where('period', $request->period)->orderByDesc('pass_fio')->get();
        //ddd($payments);
        $periodex = $request->period;

        return view('Billing.reports.saldooborot', compact('payments', 'periodex'));
    }

    public static function getexcelpostupleniye(Request $request)
    {
        return Excel::download(new OtchetExport($request->periodex), 'Saldooborot.xlsx');
    }

    //55///////////////////////////////////////////////////////////////////////////////////////////////////
    public static function getnachisleniye(Request $request)
    {

        $payments = DB::table('payment')->join('abonent', 'abonent_id', 'abonent.id')->
        select('payment.*', 'abonent.pass_fio')->
        where('period', $request->period)->orderByDesc('pass_fio')->get();
        //ddd($payments);
        $periodex = $request->period;

        return view('Billing.reports.saldooborot', compact('payments', 'periodex'));
    }

    public static function getexcelnachisleniye(Request $request)
    {
        return Excel::download(new OtchetExport($request->periodex), 'Saldooborot.xlsx');
    }


}
