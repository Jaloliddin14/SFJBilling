<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\AbonentFormRequest;
use App\Mabonent;
use App\Oplata;
use App\TipOplat;
use App\Helpers\DataDB;


class OplataController extends Controller
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
        $tip_oplat = TipOplat::all(['id', 'oplata_tip_name']);
        return view('Billing.addoplata', compact('abonents', 'tip_oplat'));
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

        $oplata = new Oplata(array(
            'abonent_id' => $request->get('ab_id'),
            'doc_sana' => $request->get('doc_sana'),
            'doc_nomer' => $request->get('doc_nomer'),
            'sana_add' => now(),
            'oplata' => $request->get('pul'),
            'oplata_id' => $request->get('item_id'),
            'user_id' => \Auth::id(),
            'period' => $period->tekoy
        ));
        $oplata->save();

        $slug = $request->get('slug');
        $abonents = DataDB::abonents($slug);
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
        $abonents = Mabonent::whereId($id)->first();
        $tip_oplat = TipOplat::all(['id', 'oplata_tip_name']);
        return view('Billing.addoplata', compact('abonents', 'tip_oplat'));
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
