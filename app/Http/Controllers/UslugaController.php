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
        $abonent_id = $request->get('ab_id');
//       ddd($request);
        $usl = Services::where('id', $request->get('item_id'))->first();
        $monthly = $usl->monthly;
        $cena_dinamic = $usl->cena_dinamic;

        //ddd($usl);
        if (!$monthly) {
            if ($cena_dinamic) {
                $usluga = new Usluganach(array(
                    'abonent_id' => $request->get('ab_id'),
                    'service_id' => $request->get('item_id'),
                    'sana_begin' => $request->get('sana_begin'),
                    'cena' => $request->get('cena'),
                    'doc_sana' => $request->get('doc_sana'),
                    'doc_nomer' => $request->get('doc_nomer'),
                    'is_active' => 1,
                    'user_id' => Auth::id(),
                    'period' => now()
                ));
                $usluga->save();
            }
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
