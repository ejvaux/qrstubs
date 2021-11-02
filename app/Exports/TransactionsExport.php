<?php

namespace App\Exports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct(string $date,int $canteen_id)
    {
        $this->date = $date;
        $this->canteen_id = $canteen_id;
    }

    /*
        HEADINGS
    */
    public function headings(): array
    {
        return [
            'Employee Number',
            'Employee Name',
            'Scanned By',
            'Amount',
            'Scanned At'
        ];
    }

    /*
        QUERY
    */
    public function query()
    {
        $transactions =  Transaction::query()->whereDate('created_at', $this->date)->where('canteen_id',$this->canteen_id);
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
            $transactions->scanner->name,
            $transactions->price,
            $transactions->created_at,
        ];
    }
}
