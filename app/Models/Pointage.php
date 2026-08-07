<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    use HasFactory;


    protected $fillable = [
        
        'date',
        'quart',
        'journalier_id',
        'atelier_id',
        'heure',
        'chef_de_quart',
        'salaire',
        'categorie',
        'taux_horaire',
        'source',
        'source_payement',
    ];

    
    protected $attributes = [
        'heure' => '00:00',
    ];


    public function atelier()
        {
            return $this->belongsTo(Atelier::class, 'atelier_id'); 
        }

    public function journalier()
        {
            return $this->belongsTo(Journalier::class, 'journalier_id'); 
        }


        
        public function tarifHoraire()
        {
            return $this->belongsTo(Tarif_Horaire::class, 'categorie', 'categorie');
        }


 //   public function getChef_de_quartAttribute()
//{
  //  $this->load('atelier.chef_de_quart');

    //$atelier = $this->atelier;

    //if ($atelier) {
      //  return $atelier->chef_de_quart->nom ?? null;
    //}

    //return null;
//}
    

protected static function booted()
        {
            parent::boot();
        
            static::creating(function ($pointage) {
                $categorie = $pointage->categorie;
        
                $tarifHoraire = Tarif_Horaire::where('categorie', $categorie)->first();
        
                if ($tarifHoraire) {
                    $pointage->taux_horaire = $tarifHoraire->taux_horaire;
                }

            });
        }
    


}
