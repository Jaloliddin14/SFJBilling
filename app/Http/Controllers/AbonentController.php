<?php

namespace App\Http\Controllers;

use App\Streets;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\AbonentFormRequest;
use App\Mabonent;
use App\Oplata;

class AbonentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Mabonent::query();

        if ($request->get('abonent_id') != '') $query = $query->where('id', $request->get('abonent_id'));
        if ($request->get('pass_fio') != '') $query = $query->where('pass_fio', 'like', '%' . $request->get('pass_fio') . '%');
        if ($request->get('phone') != '') $query = $query->where('phone', 'like', '%' . $request->get('phone') . '%');
        if ($request->get('email') != '') $query = $query->where('email', 'like', '%' . $request->get('email') . '%');

        if ($request->get('abonent_id') == '' &&
            $request->get('pass_fio') == '' &&
            $request->get('phone') == '' &&
            $request->get('email') == '') $query = $query->where('id', '<', '0');

        $abonents = $query->get();

        return view('Billing.abonentview', compact('abonents'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streetid = DB::table('street')->select('id', 'street_name')->where('is_active', '1')
            ->orderBy('street_name')->get();
        return view('Billing.createabonent', compact('streetid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbonentFormRequest $request)
    {
        $slug = uniqid();
        $mabonent = new Mabonent(array(
            'pass_fio' => $request->get('pass_fio'),
            'pass_seriya' => $request->get('pass_seriya'),
            'pass_nomer' => $request->get('pass_nomer'),
            'pass_iib' => $request->get('pass_iib'),
            'pass_sana_birth' => $request->get('pass_sana_birth'),
            'pass_sana_get' => $request->get('pass_sana_get'),
            'pass_sana_exp' => $request->get('pass_sana_exp'),
            'add_street_id' => $request->get('add_street_id'),
            'add_dom' => $request->get('add_dom'),
            'add_korpus' => $request->get('add_korpus'),
            'add_podyezd' => $request->get('add_podyezd'),
            'add_kvartira' => $request->get('add_kvartira'),
            'sana_add' => $request->get('dogovor_sana'),
            'dogovor_sana' => $request->get('dogovor_sana'),
            'dogovor_nomer' => $request->get('dogovor_nomer'),
            'is_active' => 1,
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'slug' => $slug
        ));

        $mabonent->save();

        return redirect('/')->with('status', 'Your ticket has been created! Its unique id is: ' . $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $abonents = Mabonent::whereSlug($slug)->first();
        $id = $abonents->id;
//        $oplati = DB::table('oplati')->where('abonent_id',$id)->orderByDesc('sana_add')->get();
        $oplati = DB::table('oplati')->join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        join('users', 'user_id', 'users.id')->
        select('oplati.*', 'oplata_tip.oplata_tip_name', 'users.name')->
        where('abonent_id', $id)->orderByDesc('sana_add')->get();

//        ddd($oplati);

        return view('Billing.abonentshow', compact('abonents', 'oplati'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
//        ddd($request);

        $abonent_id = $request->get('ab_id');
        $abonents = Mabonent::whereId($abonent_id)->first();
        return view('Billing.abonentedit', compact('abonents'));

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

        //ddd($request);
        $abonent_id = $request->get('ab_id');
        $ab = Mabonent::whereId($abonent_id)->first();
        //ddd($ab);
        $ab->pass_fio = $request->get('pass_fio');
        $ab->pass_seriya = $request->get('pass_seriya');
        $ab->pass_nomer = $request->get('pass_nomer');
        $ab->pass_iib = $request->get('pass_iib');
        $ab->pass_sana_birth = $request->get('pass_sana_birth');
        $ab->pass_sana_get = $request->get('pass_sana_get');
        $ab->pass_sana_exp = $request->get('pass_sana_exp');
        $ab->add_street_id = $request->get('add_street_id');
        $ab->add_dom = $request->get('add_dom');
        $ab->add_korpus = $request->get('add_korpus');
        $ab->add_podyezd = $request->get('add_podyezd');
        $ab->add_kvartira = $request->get('add_kvartira');
        $ab->sana_add = $request->get('dogovor_sana');
        $ab->dogovor_sana = $request->get('dogovor_sana');
        $ab->dogovor_nomer = $request->get('dogovor_nomer');
        $ab->phone = $request->get('phone');
        $ab->email = $request->get('email');
        $ab->save();

        $abonents = Mabonent::whereId($abonent_id)->first();
        $oplati = DB::table('oplati')->join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        join('users', 'user_id', 'users.id')->
        select('oplati.*', 'oplata_tip.oplata_tip_name', 'users.name')->
        where('abonent_id', $abonent_id)->orderByDesc('sana_add')->get();

        //ddd($oplati);
        return view('Billing.abonentshow', compact('abonents', 'oplati'));


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

    public function checkdemo(Request $request)
    {

        $query = Mabonent::query();

        if ($request->get('abonent_id') != '') $query = $query->where('id', $request->get('abonent_id'));
        if ($request->get('pass_fio') != '') $query = $query->where('pass_fio', 'like', '%' . $request->get('pass_fio') . '%');
        if ($request->get('phone') != '') $query = $query->where('phone', 'like', '%' . $request->get('phone') . '%');
        if ($request->get('email') != '') $query = $query->where('email', 'like', '%' . $request->get('email') . '%');

        if ($request->get('abonent_id') == '' &&
            $request->get('pass_fio') == '' &&
            $request->get('phone') == '' &&
            $request->get('email') == '') $query = $query->where('id', '<', '0');

        $abonents = $query->get();

        return view('Billing.test', compact('abonents'));
    }

}
