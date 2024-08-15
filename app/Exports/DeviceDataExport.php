<?php

namespace App\Exports;

use App\Models\DeviceData;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\FromCollection;

class DeviceDataExport implements FromCollection, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    /**
     * @var $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->DEVICE_ID,
            $row->S_TEMP,
            $row->S_HUM,
            $row->A_TEMP,
            $row->A_HUM,
            $row->PRED_AMOUNT,
        ];
    }
}