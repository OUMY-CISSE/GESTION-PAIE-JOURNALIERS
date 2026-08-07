<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif_Horaire extends Model
{
    use HasFactory;

    


    protected $table = 'tarif_horaires';
    protected $fillable = [
        
        'categorie',
        'taux_horaire',
    ];


}
