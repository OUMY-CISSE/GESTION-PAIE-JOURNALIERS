<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atelier extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'nom', 
    ];

    public function chef_de_quart()
    {
        return $this->hasMany(Chef_de_quart::class, 'atelier_id');
    }
    
}
