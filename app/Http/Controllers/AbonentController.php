<?php

namespace App\Http\Controllers;

use App\Streets;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\AbonentFormRequest;
use App\Helpers\DataDB;
use App\Mabonent;
use Illuminate\View\View;


class AbonentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
     * @return Factory|View
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
     * @param AbonentFormRequest $request
     * @return Response
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
            'slug' => $slug,
            'notes' => $request->get('notes'),
        ));

        $mabonent->save();

        return redirect('/')->with('status', 'Your ticket has been created! Its unique id is: ' . $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($slug)
    {
        $abonents = DataDB::abonents($slug);
        $oplati = DataDB::oplati($abonents->id);
        $uslugi = DataDB::uslugi($abonents->id);
        $payment = DataDB::payment($abonents->id);
        $payments = DataDB::payments($abonents->id);

        return view('Billing.abonentshow', compact('abonents', 'oplati', 'uslugi','payment','payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Request $request)
    {
        $abonent_id = $request->get('ab_id');
        $abonents = Mabonent::whereId($abonent_id)->first();
        $street = Streets::all();
        return view('Billing.abonentedit', compact('abonents', 'street'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $abonent_id = $request->get('ab_id');
        $slug = $request->get('slug');
        $ab = Mabonent::whereId($abonent_id)->first();
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
        $ab->notes = $request->get('notes');
        $ab->save();

        $abonents = DataDB::abonents($slug);
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
     * @return void
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
