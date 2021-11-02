<?php

namespace App\Exports;

use App\User;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /*
        HEADINGS
    */
    public function headings(): array
    {
        return [
            'Employee Number',
            'Name',
            'Department',
            'Credit Amount',
        ];
    }

    /*
        QUERY
    */
    public function query()
    {
        $users =  User::query()->where('role_id',3)->with(['department','latest_credit']);
        return $users;
    }

    /*
        MAPPING
    */
    public function map($users): array
    {
        return [
            $users->uname,
            $users->name,
            $users->department->name,
            $users->latest_credit->amount,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return User::where('role_id',3)->get();
    }*/
}
