<?php

namespace App\Exports;

use App\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionsCutOffExport implements FromQuery, WithMapping, WithHeadings, ShouldQueue
{
    use Exportable;

    public function __construct(string $fromDate,string $toDate)
    {
        $this->toDate = Carbon::parse($toDate)->addDay();
        $this->fromDate = $fromDate;
    }

    /*
        HEADINGS
    */
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

    /*
        QUERY
    */
    public function query()
    {
        $transactions =  Transaction::query()->whereBetween('created_at', [$this->fromDate,$this->toDate]);
        return $transactions;
    }

    /*
        MAPPING
    */
    public function map($transactions): array
    {
        return [
            $transactions->user->uname,
            $transactions->user->name,
            $transactions->price,
            $transactions->canteen->name,
            $transactions->created_at,
        ];
    }
}
