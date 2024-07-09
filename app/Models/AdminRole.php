<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;
    protected $table="_adminrole";
    protected $fillable =['name','role'];

    static public function getSingle($id){
        return AdminRole::find($id);
    } 
    
    static public function getrecord(){
        return AdminRole::get();
    } 
    
}
