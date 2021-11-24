<?php

namespace App\Imports;

use App\Credit;
use App\User;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class CreditsImport implements  WithHeadingRow, ToModel, WithValidation, WithBatchInserts
{
    use Importable, SkipsFailures;

    public function __construct(string $ctrl)
    {
        $this->ctrl = $ctrl;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            'employee_no' => 'Employee No',
            'name' => 'Name',
            'amount' => 'Amount'
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('uname','=',strval($row['employee_no']))->first();
        return new Credit([
            'user_id'       => $user->id,
            'control_no'    => $this->ctrl,
            'amount'        => $row['amount'],
        ]);
    }
    public function headingRow(): int
    {
        return 3;
    }

    public function rules(): array
    {
        return [
            'employee_no' => 'exists:users,uname',
            'amount' => 'numeric',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($validator->getData() as $key => $val) {
                //Log::info($val['employee_no']);
                $user = User::where('uname','=',strval($val['employee_no']))->first();
                if ($user) {
                    $ctr = Credit::where('control_no','=',$this->ctrl)->where('user_id','=',$user->id)->first();
                    if($ctr)
                    {
                        Log::info($key.'==='.$val['employee_no'].'==='.$validator->errors());
                        //Log::info($ctr);
                        $validator->errors()->add($key.'.Employee No', 'Employee\'s Credit already exists.');
                    }
                }
            }
        });
    }

    public function prepareForValidation($data, $index)
    {
        $data['employee_no'] = strval($data['employee_no']);

        return $data;
    }

    public function customValidationMessages()
    {
        return [
            'employee_no.exists' => "Employee doesn't exists in the database.",
        ];
    }
}
