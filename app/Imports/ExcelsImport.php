<?php

namespace App\Imports;


use App\Models\Excels;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class ExcelsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $dateValue = $row['date'];

        if (is_numeric($dateValue)) {
            // Cas 1 : Excel a stocké une vraie date (numéro de série)
            $unixDate = ($dateValue - 25569) * 86400;
            $date = gmdate("Y-m-d", $unixDate);
        } elseif (!empty($dateValue)) {
            // Cas 2 : la cellule est du texte (ex: "2026-07-01", "01/07/2026", ...)
            try {
                $date = Carbon::parse($dateValue)->format('Y-m-d');
            } catch (\Exception $e) {
                $date = null; // format de date non reconnu
            }
        } else {
            $date = null; // cellule vide
        }

        return new Excels([
            'categorie'=> $row['categorie'], 
            'atelier' => $row['atelier'],
            'quart' => $row['quart'],
            'prenom' => $row['prenom'],
            'nom' => $row['nom'],
            'date' => $date,
            'chef_de_quart' => $row['chef_de_quart'],
            'heure' => $row['heure'],
            'taux_horaire' => $row['taux_horaire'],
            'salaire' => $row['salaire'],
 
        ]);
    }
}