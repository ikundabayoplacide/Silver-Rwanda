<?php

namespace App\Exports;

use App\Models\DeviceData;
use Maatwebsite\Excel\Concerns\FromCollection;

class DeviceDataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }
}