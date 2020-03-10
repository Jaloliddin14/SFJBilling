<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class OtchetExport implements FromCollection, WithHeadings
{

    function __construct($periodex)
    {
        $this->periodex = $periodex;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('payment')->join('abonent', 'abonent_id', 'abonent.id')->
        select('payment.id', 'abonent.pass_fio', 'payment.saldo_begin', 'payment.service_nach',
            'payment.oplata', 'payment.saldo_end', 'payment.period')->
        where('period', $this->periodex)->orderByDesc('pass_fio')->get();
    }

    public function headings(): array
    {
        return [
            'Счет',
            'Ф.И.О. Абонента',
            'Сальдо на начало',
            'Начисление',
            'Оплаты',
            'Сальдо на конец',
            'Месяц',
        ];
    }
}
