<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef_de_quart extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'nom',
        'matricule',
        'atelier_id',
        
    ];

    public function atelier()
    {
        return $this->belongsTo(Atelier::class, 'atelier_id');
    }

    
    
    
}
