<?php

namespace App\Http\Controllers;


use App\ServiceCena;
use App\Services;
use App\Streets;
use App\TipOplat;
use App\User;
use App\Users;
use Illuminate\Http\Request;
use App\StreetTip;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {
        $str = ServiceCena::where('id', '3')->get();
        //   ddd($str);
        return view('Billing.test', compact('str'));
    }

    ////////////////////////////////////////Тип адресов///////////////////////////////////////////

    public function streettipcreateindex()
    {
        $streettip = StreetTip::all();
        return view('Billing.editsettings.tipstreet', compact('streettip'));
    }

    public function addstreettip(Request $request)
    {
        $this->validate($request, [
            'tip_street_name' => 'required',
        ], [
            'tip_street_name.required' => 'Поле Тип адреса обязательно для заполнения',
        ]);

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
        $this->validate($request, [
            'tip_street_name' => 'required',
        ], [
            'tip_street_name.required' => 'Поле Тип адреса обязательно для заполнения',
        ]);

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
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Адрес ////////////////////////////////////////////

    public function streetcreateindex()
    {
        $street = Streets::query()
            ->join('street_tip', 'street_tip_id', 'street_tip.id')
            ->select('street.*', 'street_tip.street_tip_name')
            ->orderBy('id')
            ->get();

        $street_tip = StreetTip::all();
        return view('Billing.editsettings.street', compact('street', 'street_tip'));
    }

    public function addstreet(Request $request)
    {
        $this->validate($request, [
            'street_name' => 'required',
            'tip_street_item_id' => 'required',
        ], [
            'street_name.required' => 'Поле Адрес обязательно для заполнения',
            'tip_street_item_id.required' => 'Поле Тип адреса обязательно для заполнения',
        ]);

        $streetadd = new Streets(array(
                'street_name' => $request->get('street_name'),
                'street_tip_id' => $request->get('tip_street_item_id'),
                'is_active' => 1
            )
        );
        $streetadd->save();
        $street = Streets::query()
            ->join('street_tip', 'street_tip_id', 'street_tip.id')
            ->select('street.*', 'street_tip.street_tip_name')
            ->orderBy('id')
            ->get();

        $street_tip = StreetTip::all();
        return view('Billing.editsettings.street', compact('street', 'street_tip'));
    }

    public function editstreet($id)
    {
        $street = Streets::where('id', $id)->first();
        $streettip = StreetTip::all();
        return view('Billing.editsettings.editstreet', compact('street', 'streettip'));
    }

    public function updatestreet(Request $request)
    {
        $this->validate($request, [
            'street_name' => 'required',
            'tip_street_item_id' => 'required',
        ], [
            'street_name.required' => 'Поле Адрес обязательно для заполнения',
            'tip_street_item_id.required' => 'Поле Тип адреса обязательно для заполнения',
        ]);

        $idd = $request->get('id');
        $streetupdate = Streets::where('id', $idd)->first();

        $streetupdate->street_name = $request->get('street_name');
        $streetupdate->street_tip_id = $request->get('tip_street_item_id');
        if ($request->get('isactive') != null) {
            $streetupdate->is_active = 1;
        } else {
            $streetupdate->is_active = 0;
        }
        $streetupdate->save();

        $street = Streets::query()
            ->join('street_tip', 'street_tip_id', 'street_tip.id')
            ->select('street.*', 'street_tip.street_tip_name')
            ->orderBy('id')
            ->get();

        $street_tip = StreetTip::all();
        return view('Billing.editsettings.street', compact('street', 'street_tip'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Тип оплаты ////////////////////////////////////////////

    public function oplatatipcreateindex()
    {
        $oplatatip = TipOplat::all();
        return view('Billing.editsettings.oplatatip', compact('oplatatip'));
    }

    public function addoplatatip(Request $request)
    {
        $this->validate($request, [
            'tip_oplati' => 'required',
        ], [
            'tip_oplati.required' => 'Поле Тип Оплаты обязательно для заполнения',
        ]);

        $oplatatipadd = new TipOplat(array(
                'oplata_tip_name' => $request->get('tip_oplati'),
                'is_active' => 1
            )
        );
        $oplatatipadd->save();
        $oplatatip = TipOplat::all();
        return view('Billing.editsettings.oplatatip', compact('oplatatip'));
    }

    public function editoplatatip($id)
    {
        $oplatatip = TipOplat::where('id', $id)->first();
        return view('Billing.editsettings.editoplatatip', compact('oplatatip'));
    }

    public function updateoplatatip(Request $request)
    {
        $this->validate($request, [
            'tip_oplati' => 'required',
        ], [
            'tip_oplati.required' => 'Поле Тип Оплаты обязательно для заполнения',
        ]);

        $idd = $request->get('id');
        $oplatatipupdate = TipOplat::where('id', $idd)->first();

        $oplatatipupdate->oplata_tip_name = $request->get('tip_oplata_name');
        if ($request->get('isactive') != null) {
            $oplatatipupdate->is_active = 1;
        } else {
            $oplatatipupdate->is_active = 0;
        }
        $oplatatipupdate->save();

        $oplatatip = TipOplat::all();
        return view('Billing.editsettings.oplatatip', compact('oplatatip'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Услуга ////////////////////////////////////////////

    public function servicecreateindex()
    {
        $services = Services::all();
        return view('Billing.editsettings.services', compact('services'));
    }

    public function addservice(Request $request)
    {
        $this->validate($request, [
            'service_name' => 'required',
            'monthly' => 'required',
            'cena_dinamic' => 'required',
        ], [
            'service_name.required' => 'Поле Наименование услуги обязательно для заполнения',
            'monthly.required' => 'Поле Периодичность услуги обязательно для заполнения',
            'cena_dinamic.required' => 'Поле Стоимость обязательно для заполнения',
        ]);

        $serviceadd = new Services(array(
                'service_name' => $request->get('service_name'),
                'is_active' => 1,
                'monthly' => $request->get('monthly'),
                'cena_dinamic' => $request->get('cena_dinamic'),
            )
        );
        $serviceadd->save();
        $services = Services::all();
        return view('Billing.editsettings.services', compact('services'));
    }

    public function editservice($id)
    {
        $services = Services::where('id', $id)->first();
        return view('Billing.editsettings.editservices', compact('services'));
    }

    public function updateservice(Request $request)
    {
        $this->validate($request, [
            'service_name' => 'required',
            'monthly' => 'required',
            'cena_dinamic' => 'required',
        ], [
            'service_name.required' => 'Поле Наименование услуги обязательно для заполнения',
            'monthly.required' => 'Поле Периодичность услуги обязательно для заполнения',
            'cena_dinamic.required' => 'Поле Стоимость обязательно для заполнения',
        ]);

        $idd = $request->get('id');
        $service = Services::where('id', $idd)->first();

        $service->service_name = $request->get('service_name');
        $service->monthly = $request->get('monthly');
        if ($request->get('isactive') != null) {
            $service->is_active = 1;
        } else {
            $service->is_active = 0;
        }

        $service->save();

        $services = Services::all();
        return view('Billing.editsettings.services', compact('services'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Цена Услуги ////////////////////////////////////////////
    public function servicecenacreateindex()
    {
        $servicecena = Services::where('cena_dinamic', '0')->where('is_active', '1')->get();
        return view('Billing.editsettings.servicecena', compact('servicecena'));
    }

    public function editservicecena($id)
    {
        $servicecena = ServiceCena::where('service_id', $id)->get();
        $service = Services::where('id', $id)->first();
        return view('Billing.editsettings.editservicecena', compact('servicecena', 'service'));
    }

    public function addservicecena(Request $request)
    {
        $id = $request->get('service_id');
        $lastsana = ServiceCena::where('service_id', $id)->where('is_active', '1')->first();
        if ($lastsana != null) { //'2099-01-01'
            if ((((strtotime($request->get('sana_begin')) - strtotime($lastsana->sana_begin)) / 86400) >= 2)
                && ($request->get('pul') != null)) {

                $sana_end = date('Y-m-d', strtotime($request->get('sana_begin') . " - 1 day"));
                $lastsana->is_active = 0;
                $lastsana->sana_end = $sana_end;
                $lastsana->save();
            } else {
                $servicecena = ServiceCena::where('service_id', $id)->get();
                $service = Services::where('id', $id)->first();
                return view('Billing.editsettings.editservicecena', compact('servicecena', 'service'))->withErrors(['Внимание', 'Ошибка']);
            }
        }

        $servicecenaadd = new ServiceCena(array(
                'service_id' => $request->get('service_id'),
                'cena' => $request->get('pul'),
                'sana_begin' => $request->get('sana_begin'),
                'sana_end' => '2099-01-01',
                'is_active' => 1
            )
        );
        $servicecenaadd->save();

        $servicecena = ServiceCena::where('service_id', $id)->get();
        $service = Services::where('id', $id)->first();
        return view('Billing.editsettings.editservicecena', compact('servicecena', 'service'));
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Пользователи ////////////////////////////////////////////

    public function userscreateindex()
    {
        $usrs = Users::all();
        return view('Billing.editsettings.userregister', compact('usrs'));
    }

    public function addusers(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Поле Фамилия Имя Отчество услуги обязательно для заполнения',
            'email.required' => 'Поле Электронная почта услуги обязательно для заполнения',
            'password.required' => 'Поле Пароль обязательно для заполнения',
        ]);
        $useradd = new Users(array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
//                'is_active' => 1,
                'password' => Hash::make($request->get('password')),
            )
        );
        $useradd->save();

        $usrs = Users::all();
        return view('Billing.editsettings.userregister', compact('usrs'));
    }

    public function editusers($id)
    {
        $usrs = Users::where('id', $id)->first();
        return view('Billing.editsettings.useredit', compact('usrs'));
    }

    public function updateusers(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Поле Фамилия Имя Отчество услуги обязательно для заполнения',
            'email.required' => 'Поле Электронная почта услуги обязательно для заполнения',
            'password.required' => 'Поле Пароль обязательно для заполнения',
        ]);

        $idd = $request->get('id');

        $users = Users::where('id', $idd)->first();
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->password = Hash::make($request->get('password'));
        $users->save();

        $usrs = Users::all();
        return view('Billing.editsettings.userregister', compact('usrs'));
    }

     //////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Роли пользователя /////////////////////////////////////

    public function editusersrole($id)
    {
        $usrs = Users::where('id', $id)->first();
        $user = User::query()->find($id);
        $roles = $user->getRoleNames();
        //ddd($roles);
        return view('Billing.editsettings.userrole', compact('usrs', 'roles'));
    }

    public function updateusersrole(Request $request)
    {
        //ddd($request);
        $user = User::query()->find($request->id);
        if ($request->has('admin')) {
            $user->assignRole('Admin');
        } else {
            $user->removeRole('Admin');
        }
        if ($request->has('manager')) {
            $user->assignRole('Manager');
        } else {
            $user->removeRole('Manager');
        }
        if ($request->has('cashier')) {
            $user->assignRole('Cashier');
        } else {
            $user->removeRole('Cashier');
        }
        $usrs = Users::all();
        return view('Billing.editsettings.userregister', compact('usrs'));

    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////// Закрытие месяца /////////////////////////////////////

    public function closemonthpage()
    {
        $close = DB::table('syssana')->first();
        return view('Billing.editsettings.closemonth', compact('close'));
    }

    public function closemonthfunc()
    {
        $it = DB::select('select end_month() as id');
        //ddd($it);
        $close = DB::table('syssana')->first();
        return view('Billing.editsettings.closemonth', compact('close'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////

}
