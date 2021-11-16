<?php

namespace App\Imports;

use App\Credit;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CreditsImport implements  WithHeadingRow, ToModel
{
    use Importable;

    public function __construct(string $ctrl)
    {
        $this->ctrl = $ctrl;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row['employee_no'] != ''){
            $user = User::where('uname','=',strval($row['employee_no']))->first();
            return new Credit([
                'user_id'       => $user->id,
                'control_no'    => $this->ctrl,
                'amount'        => $row['amount'],
            ]);
        }

    }
}
