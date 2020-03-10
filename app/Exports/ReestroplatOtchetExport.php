<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ReestroplatOtchetExport implements FromCollection, WithHeadings
{
    function __construct($periodot,$perioddo)
    {
        $this->periodot = $periodot;
        $this->perioddo = $perioddo;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('oplati')->join('abonent', 'abonent_id', 'abonent.id')->
        join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        join('users', 'user_id', 'users.id')->
        select('oplati.id', 'abonent.pass_fio','oplati.doc_nomer','oplati.doc_sana','oplati.sana_add',
            'oplati.oplata','oplata_tip.oplata_tip_name','users.name','oplati.period')->
        whereBetween('oplati.sana_add', [$this->periodot, $this->perioddo])->orderBy('id')->get();
    }

    public function headings(): array
    {
        return [
            '№ оплаты',
            'Ф.И.О. Абонента',
            '№ Документа',
            'Дата документа',
            'Дата приема олаты',
            'Сумма',
            'Тип оплаты',
            'Пользователь',
            'Месяц',
        ];
    }

}
