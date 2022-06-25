<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goldbar extends Model
{
    use HasFactory;
    protected $fillable = [
      'weight_id','safetype_id','SerialNumber','safe_id'
    
  ];
    public function safe(){

      return  $this->belongsTo(safe::class);
    }
  
    public function weight(){

        return $this->belongsTo(weight::class);
    }
    public function safetype(){

      return $this->belongsTo(safetype::class);
   }

}
