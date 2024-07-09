<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cooperative extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'services_offered',
    ];

    public function farmer(){
        return $this->hasMany(Farmer::class);
    }
}