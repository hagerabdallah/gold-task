<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
    protected $fillable = [
        'CountryName',
      
    ];
    
    public function safes()
    {
     return   $this->hasMany(safe::class);
    }
}
