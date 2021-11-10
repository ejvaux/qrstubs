<?php

namespace App\Exports;

use App\User;
use App\Transaction;
use App\Credit;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersCreditExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Employee Number',
            'Name',
            'Control No',
            'Credit Amount',
            'Balance',
            'Expiration',
        ];
    }
    public function query()
    {
        $users =  User::with('latest_credit')->where('role_id',3)->where('status', 0);
        return $users;
    }

    public function map($users): array
    {
        return [
            $users->uname,
            $users->name,
            $users->latest_credit->control_no,
            $users->latest_credit->amount,
            
        ];
    }
}
