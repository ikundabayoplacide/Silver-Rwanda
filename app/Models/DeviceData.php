<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{
    use HasFactory;
    protected $table="device_data";
    protected $primaryKey="id";
    protected $fillable=[
        'DEVICE_ID','S_TEMP','S_HUM','A_TEMP','A_HUM','farmer_id'
    ];

    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }
}