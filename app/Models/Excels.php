<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excels extends Model
{
    use HasFactory;


    protected $fillable = [
        
        'categorie',
        'atelier',
        'quart',
        'prenom',
        'nom',
        'date',
        'chef_de_quart',
        'heure',
        'taux_horaire',
        'salaire',
    ];

      


}
