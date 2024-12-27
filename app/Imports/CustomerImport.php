<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class CustomerImport implements ToModel
{
    use SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row[0],           // Assuming 'name' is the header in the file
            'email' => $row[1],         // Assuming 'email' is the header in the file
            'phone_number' => $row[2], 
            'address' => $row[3], 
        ]);
    }
}
