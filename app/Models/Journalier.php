<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journalier extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'nom',
        'prenom',
        'categorie',
        'date_naiss',
        'lieu_naiss',
        'age',
        'CIN',
        'taux_horaire',
        'date_creation',
        
    ];


    protected static function booted()
        {
            parent::boot();
        
            static::creating(function ($journalier) {
                $categorie = $journalier->categorie;
        
                $tarifHoraire = Tarif_Horaire::where('categorie', $categorie)->first();
        
                if ($tarifHoraire) {
                    $journalier->taux_horaire = $tarifHoraire->taux_horaire;
                }
        
                
            });
        }

    
    
        public function tarifHoraire()
        {
            return $this->belongsTo(Tarif_Horaire::class, 'categorie', 'categorie');
        }


       
}
