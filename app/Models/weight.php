<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weight extends Model
{
    use HasFactory;
    protected $fillable = [
      'weight',
    
  ];
    public function goldbars()
    {
      return  $this->hasMany(goldbar::class);
    }
}
