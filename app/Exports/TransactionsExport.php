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

class TransactionsExport implements FromQuery, WithMapping, WithHeadings, ShouldQueue
{
    use Exportable;

    public function __construct(string $fromDate,string $toDate,int $canteenId)
    {
        $this->fromDate = Carbon::parse($fromDate)->format('Y-m-d 00:00:00');
        $this->toDate = Carbon::parse($toDate)->format('Y-m-d 23:59:59');
        $this->canteenId = $canteenId;
    }

    /*
        HEADINGS
    */
    public function headings(): array
    {
        return [
            'ID',
            'Employee Number',
            'Employee Name',
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
        //return $transactions;
        if($transactions->count() > 0){
            return $transactions;
        }
        else{
            throw new \ErrorException("No Data Found");
            //abort(404,"No Data Found");
        }
    }

    /*
        MAPPING
    */
    public function map($transactions): array
    {
        return [
            $transactions->id,
            $transactions->user->uname,
            $transactions->user->name,
            $transactions->price,
            $transactions->created_at,
        ];
    }
}
