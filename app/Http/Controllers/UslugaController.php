<?php

namespace App\Http\Controllers;

use App\Helpers\DataDB;
use App\Mabonent;
use App\Services;
use App\Streets;
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
        //ddd($tip_uslugi);
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
                $cena1 = DB::select('SELECT distinct get_cena(:sid,:sana) as cn FROM services', ['sid' => $sid, 'sana' => $sana_bg]);
                $cena = $cena1[0]->cn;
            }
            $usluga = new Usluganach(array(
                'abonent_id' => $request->get('ab_id'),
                'service_id' => $request->get('item_id'),
                'sana_begin' => $request->get('sana_begin'),
                'cena' => $cena,
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


                    $ssana = date("Y-m-d", strtotime("+1 month", strtotime($ssana)));
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


        $abon_id = Mabonent::whereId($request->get('ab_id'))->first();

        $abonents = DataDB::abonents($abon_id->slug);
        $oplati = DataDB::oplati($abonents->id);
        $uslugi = DataDB::uslugi($abonents->id);
        $payment = DataDB::payment($abonents->id);
        $payments = DataDB::payments($abonents->id);

        return view('Billing.abonentshow', compact('abonents', 'oplati', 'uslugi','payment','payments'));

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
        //$usl = Usluganach::where('id',$id)->get();
        $usl = DB::table('service_nach')->
        join('services', 'service_id', 'services.id')->
        join('abonent', 'abonent_id', 'abonent.id')->
        select('service_nach.*', 'abonent.pass_fio', 'services.service_name')->
        where('service_nach.id', $id)->orderByDesc('id')->first();

        //ddd($uslugi);
        return view('Billing.endusluga', compact('usl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sid = $request->get('sid');
        $syssana = DB::table('syssana')->first('tekoy');
        $sana_begin_month = $syssana->tekoy;
        $sana_end_month = date("Y-m-d", strtotime("+1 month", strtotime($sana_begin_month)));
        $sana_end = $request->get('sana_end');
        if ($sana_begin_month > $sana_end && $sana_end_month < $sana_end) {
            ddd($sana_end);
        }
        $month_days = cal_days_in_month(CAL_GREGORIAN, getdate(strtotime($sana_begin_month))['mon'], getdate(strtotime($sana_begin_month))['year']);
        $itdays = getdate(strtotime($sana_end))['mday'];

        $tarif_cena = DB::select('SELECT distinct get_cena(:sid,:sana) as cn FROM services', ['sid' => $sid, 'sana' => $sana_end]);
        $itcena = ($tarif_cena[0]->cn / $month_days) * $itdays;

        //ddd($request->get('id'));
        $updateusl = Usluganach::whereId($request->get('id'))->first();
        $updateusl->sana_end = $sana_end;
        $updateusl->cena = $itcena;
        $updateusl->save();

        $abon_id = Mabonent::whereId($request->get('ab_id'))->first();

        $abonents = DataDB::abonents($abon_id->slug);
        $oplati = DataDB::oplati($abonents->id);
        $uslugi = DataDB::uslugi($abonents->id);
        $payment = DataDB::payment($abonents->id);
        $payments = DataDB::payments($abonents->id);

        return view('Billing.abonentshow', compact('abonents', 'oplati', 'uslugi','payment','payments'));

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
