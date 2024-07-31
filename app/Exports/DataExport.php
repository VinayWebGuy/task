<?php
namespace App\Exports;
use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class DataExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Data::all(['name', 'password', 'email', 'mobile', 'date', 'role']);
    }
    public function headings(): array
    {
        return [
            'Name',
            'Password',
            'Email',
            'Mobile',
            'Date',
            'Role'
        ];
    }
}
