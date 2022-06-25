<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class safe extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id','safetype_id','name'
      
    ];
    public function country(){

      return  $this->belongsTo(country::class);
    }
    public function goldbars()
    {
     return   $this->hasMany(goldbar::class);
    }
    public function safetype(){

       return $this->belongsTo(safetype::class);
    }
}
