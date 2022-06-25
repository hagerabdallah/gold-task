<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class safetype extends Model
{
    use HasFactory;
    protected $fillable = [
        'types',
      
    ];
    public function safes(){
       return $this->hasMany(safe::class);
    }
    public function goldbars(){
        return $this->hasMany(goldbar::class);
     }
    
}
