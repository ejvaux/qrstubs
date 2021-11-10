<?php

namespace App\Exports;

use App\User;
use App\CustomFunctions;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct(string $ctrl)
    {
        $this->ctrl = $ctrl;
    }

    /*
        HEADINGS
    */
    public function headings(): array
    {
        return [
            'Employee Number',
            'Name',
            'Department',
            'Control Number',
            'Credit Amount',
            'Balance',
            'Expiration Date',
        ];
    }

    /*
        QUERY
    */
    public function query()
    {
        /*$users =  User::query()->where('role_id',3)->with(['department',"credits" => function($q){
            $q->where('control_no', $this->ctrl);
        }]);*/
        $ctrl = $this->ctrl;
        $users = User::query()->where('role_id',3)->with(['department','credits' => function($q) use ($ctrl) {
            $q->where('control_no', $ctrl);
        },'transactions' => function($q) use($ctrl){
            $q->where('transactions.control_no', $ctrl);
        }]);
        return $users;
    }

    /*
        MAPPING
    */
    public function map($users): array
    {
        if (isset($users->credits[0])) {
            $ctrln = $users->credits[0]->control_no;
            $amount = $users->credits[0]->amount;
            /*$ctrln = 'SPI202110B';
            $amount = 2000;*/
            $balance = $amount - $users->transactions->sum('price');
            $expiration = CustomFunctions::generateExpirationDate($ctrln);
        } else {
            $ctrln = '';
            $amount = '';
            $balance = '';
            $expiration = '';
        }
        return [
            $users->uname,
            $users->name,
            $users->department->name,
            $ctrln,
            $amount,
            $balance,
            $expiration,
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
