<?php

namespace App\Exports;

use App\credit;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;

class SummaryCreditExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct(string $fromDate,string $toDate)
    {
        $this->toDate = Carbon::parse($toDate)->addDay();
        $this->fromDate = $fromDate;
    }

    /* HEADINGS */
    public function headings(): array
    {
        return [
            'Employee Number',
            'Employee Name',
            'Amount',
            'Canteen',
            'Scanned At'
        ];
    }

    /* QUERY */
    public function query()
    {
        $credits =  Credit::query()->whereBetween('created_at', [$this->fromDate,$this->toDate]);
        return $transactions;
    }
    public function map($transactions): array
    {
        return [
            $credits->user->uname,
            $credits->user->name,
            $credits->amount,
            $credits->canteen->name,
            $credits->created_at,
        ];
    }
}
