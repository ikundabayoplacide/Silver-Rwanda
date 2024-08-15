<?php

namespace App\Exports;

use App\Models\Farmer;
use Maatwebsite\Excel\Concerns\FromCollection;

class FarmerExport implements FromCollection
{
     /**
    * @return \Illuminate\Support\Collection
    */
    protected $farmers;

    public function __construct($farmers)
    {
        $this->farmers = $farmers;
    }

    public function collection()
    {
        return Farmer::select('id', 'name', 'email', 'district', 'phone','gender')->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'District',
            'Phone',
            'gender'
        ];
    }
}
