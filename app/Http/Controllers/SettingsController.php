<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\StreetTip;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //Тип адресов
    public function streettipcreateindex()
    {
        $streettip = StreetTip::all();
        return view('Billing.editsettings.tipstreet', compact('streettip'));
    }

    public function addstreettip(Request $request)
    {
        //ddd($request);
        $streettip = new StreetTip(array(
                'street_tip_name' => $request->get('tip_street_name'),
                'is_active' => 1
            )
        );
        $streettip->save();
        $streettip = StreetTip::all();
        return view('Billing.editsettings.tipstreet', compact('streettip'));
    }

    public function editstreettip($id)
    {
        $streettip = StreetTip::where('id', $id)->first();
        return view('Billing.editsettings.editstreettip', compact('streettip'));
    }

    public function updatestreettip(Request $request)
    {
        //ddd($request);
        $idd = $request->get('id');
        $streettipupdate = StreetTip::where('id', $idd)->first();
        //ddd($streettip);
        $streettipupdate->street_tip_name = $request->get('tip_street_name');
        if ($request->get('isactive') != null) {
            $streettipupdate->is_active = 1;
        } else {
            $streettipupdate->is_active = 0;
        }
        $streettipupdate->save();
        $streettip = StreetTip::all();
        return view('Billing.editsettings.tipstreet', compact('streettip'));
    }


}
