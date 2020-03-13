<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PostupleniyeOtchetExport implements FromCollection
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
        return DB::table('oplati')->
        join('oplata_tip', 'oplata_id', 'oplata_tip.id')->
        select('oplati.period','oplata_tip.oplata_tip_name', DB::raw('sum(oplati.oplata) as oplata'))->
        where('period', $this->periodex)->groupBy('oplati.period','oplata_tip.oplata_tip_name')->
        orderByDesc('oplata_tip.oplata_tip_name')->get();
    }

    public function headings(): array
    {
        return [
            'Месяц',
            'Тип оплаты',
            'Сумма',
        ];
    }
}
