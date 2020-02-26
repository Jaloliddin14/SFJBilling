<?php

namespace App\Http\Controllers;

use App\Mabonent;
use App\Services;
use App\Usluganach;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UslugaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->get('ab_id');
        $abonents = Mabonent::whereId($id)->first();
        $tip_uslugi = DB::table('services')->where('is_active', '1')->get();
        return view('Billing.addusluga', compact('abonents', 'tip_uslugi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $period = DB::table('syssana')->first('tekoy');
        $sid = $request->get('item_id');
        $abonent_id = $request->get('ab_id');
        $ssana = $request->get('sana_begin');
        $sana_bg = $request->get('sana_begin');
        $sana_ed1 = DB::select('SELECT tekoy FROM syssana');
        $sana_ed = $sana_ed1[0]; //------------->?????
        $lastday = date('Y-m-t', strtotime($sana_ed->tekoy));
        $firs_day = date('Y-m-01', strtotime($sana_bg));

        $usl = Services::where('id', $request->get('item_id'))->first();
        $monthly = $usl->monthly;
        $cena_dinamic = $usl->cena_dinamic;


        if (!$monthly) {
            if ($cena_dinamic) {
                $cena = $request->get('cena');
            } else {
                $cena = DB::select('SELECT distinct get_cena(:sid,:sana) as cn FROM services', ['sid' => $sid, 'sana' => $sana_bg]);
            }
            $usluga = new Usluganach(array(
                'abonent_id' => $request->get('ab_id'),
                'service_id' => $request->get('item_id'),
                'sana_begin' => $request->get('sana_begin'),
                'cena' => $cena[0]->cn,
                'doc_sana' => $request->get('doc_sana'),
                'doc_nomer' => $request->get('doc_nomer'),
                'is_active' => 1,
                'user_id' => Auth::id(),
                'period' => $period->tekoy
            ));
            $usluga->save();
        } else {
            $itcena = 0;

            $month_cnt = (getdate(strtotime($lastday))['mon'] - getdate(strtotime($sana_bg))['mon'] + 1 +
                (getdate(strtotime($lastday))['year'] - getdate(strtotime($sana_bg))['year']) * 12);
            $xmonth = 0;
            //ddd($month_cnt);
            for ($i = 0; $i < $month_cnt; $i++) {
                if ($i == 0) {
                    $mdays = cal_days_in_month(CAL_GREGORIAN, getdate(strtotime($sana_bg))['mon'], getdate(strtotime($sana_bg))['year']);
                    $bdays = getdate(strtotime($sana_bg))['mday'];
                    $itdays = $mdays - $bdays + 1;
                    $tarif_cena = DB::select('SELECT distinct get_cena(:sid,:sana) as cn FROM services', ['sid' => $sid, 'sana' => $sana_bg]);
                    $itcena = ($tarif_cena[0]->cn / $mdays) * $itdays;
                    $xmonth = $xmonth + 1;
                    //ddd($itcena);
                } else {

                    $firs_day = strtotime($ssana);
                    $ssana = date("Y-m-d", strtotime("+1 month", $firs_day));
                    $tarif_cena = DB::select('SELECT distinct get_cena(:sid,:sana) as cn FROM services', ['sid' => $sid, 'sana' => $ssana]);
                    $itcena = $itcena + $tarif_cena[0]->cn;

                    //$ssana = strtotime($sana_bg);

                    //$ssana->modify('first day of this month');
                    //ddd($ssana);
                    $xmonth = $xmonth + 1;
//                    $time = strtotime("2010.12.11");
//                    $final = date("Y-m-d", strtotime("+1 month", $time));
//                  $cena = DB::select('SELECT distinct get_cena(:sid,:sana) as cn FROM services', ['sid' => $sid, 'sana' => $sana_bg]);
                }

                //ddd($itcena);


            }
            $usluga = new Usluganach(array(
                'abonent_id' => $request->get('ab_id'),
                'service_id' => $request->get('item_id'),
                'sana_begin' => $request->get('sana_begin'),
                'cena' => $itcena,
                'doc_sana' => $request->get('doc_sana'),
                'doc_nomer' => $request->get('doc_nomer'),
                'is_active' => 1,
                'user_id' => Auth::id(),
                'period' => $period->tekoy
            ));
            $usluga->save();
        }

        $abonents = DB::table('abonent')->join('street', 'add_street_id', 'street.id')->
        select('abonent.*', 'street.street_name')->
        where('slug', $request->get('slug'))->first();

        $oplati = DB::table('oplati')->join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        join('users', 'user_id', 'users.id')->
        select('oplati.*', 'oplata_tip.oplata_tip_name', 'users.name')->
        where('abonent_id', $abonent_id)->orderByDesc('sana_add')->get();

        $uslugi = DB::table('service_nach')->
        join('services', 'service_id', 'services.id')->
        join('users', 'user_id', 'users.id')->
        select('service_nach.*', 'users.name', 'services.service_name')->
        where('abonent_id', $abonent_id)->orderByDesc('id')->get();

        return view('Billing.abonentshow', compact('abonents', 'oplati', 'uslugi'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
