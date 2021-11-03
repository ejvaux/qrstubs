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

    public function __construct(string $fromDate,string $toDate,int $canteenId)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->canteenId = $canteenId;
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
        $transactions =  Transaction::query()->whereBetween('created_at', [$this->fromDate,$this->toDate])->where('canteen_id',$this->canteenId);
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
