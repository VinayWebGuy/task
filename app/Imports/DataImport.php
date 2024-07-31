<?php
namespace App\Imports;
use App\Models\Data;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class DataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = is_numeric($row['date']) 
        ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']) 
        : \Carbon\Carbon::parse($row['date']);
        return new Data([
            'name' => $row['name'],
            'password' => $row['password'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'date' => $date,
            'role' => $row['role']
        ]);                     
    }
}
