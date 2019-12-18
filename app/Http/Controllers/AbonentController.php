<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AbonentFormRequest;
use App\Mabonent;

class AbonentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonents = Mabonent::all();
        return view('Billing.abonentview',compact('abonents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Billing.createabonent');
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

        return redirect('/createabonent')->with('status','Your ticket has been created! Its unique id is: '.$slug);
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
        return view('Billing.abonentshow',compact('abonents'));

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
