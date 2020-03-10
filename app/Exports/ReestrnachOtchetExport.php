<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ReestrnachOtchetExport implements FromCollection, WithHeadings
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
        return DB::table('service_nach')->join('abonent', 'abonent_id', 'abonent.id')->
        join('services', 'service_id', 'services.id')->
        select('service_nach.abonent_id', 'abonent.pass_fio','services.service_name','service_nach.sana_begin',
            'service_nach.sana_end','service_nach.cena','service_nach.doc_nomer','service_nach.doc_sana',
            'service_nach.period')->where('period', $this->periodex)->orderByDesc('pass_fio')->get();
    }

    public function headings(): array
    {
        return [
            'Счет',
            'Ф.И.О. Абонента',
            'Услуга',
            'Дата начало',
            'Дата конец',
            'Сумма',
            'Номер документа',
            'Дата документа',
            'Период ',
        ];
    }

}
