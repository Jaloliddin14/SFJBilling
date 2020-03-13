<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class NachisleniyeOtchetExport implements FromCollection, WithHeadings
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
        return DB::table('service_nach')->
        join('services', 'service_id', 'services.id')->
        select('service_nach.period','services.service_name', DB::raw('sum(service_nach.cena) as cena'))->
        where('period', $this->periodex)->groupBy('service_nach.period','services.service_name')->
        orderByDesc('services.service_name')->get();
    }

    public function headings(): array
    {
        return [
            'Месяц',
            'Услуга',
            'Сумма',
        ];
    }
}
