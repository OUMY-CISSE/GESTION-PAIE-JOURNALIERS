<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use App\Models\Chef_de_quart;
use App\Models\Journalier;
use App\Models\Pointage;
use App\Models\Tarif_Horaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class PointageController extends Controller
{

//1ere Partie: PointageController pour la fiche de création du journalier et son payement par semaine    
public function index()
    {
        $ateliers['data'] = Atelier::orderby("nom", "asc")->select(['nom', 'id'])->get();
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray();
        
        $pointagePayement = Pointage::with(['atelier'])
            ->where('source_payement', 'payement')
            ->orderBy('created_at', 'DESC')// ordre d'affichage
            ->get();

        return view('pointage.index', compact('ateliers','pointagePayement', 'categories'));
    }

    

    
public function add() 
    {
        $ateliers['data'] = Atelier::orderby("nom", "asc")->select(['nom', 'id'])->get();
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray(); 


        return view("pointage.add", compact('ateliers', 'categories'));
    }

public function search(Request $request) 
{
    if($request->ajax())
    {
        $data = Journalier::where('id','like','%'.$request->search.'%')
            ->orwhere('nom','like','%'.$request->search.'%')
            ->orwhere('prenom','like','%'.$request->search.'%')
            ->get();

        $output = collect();

        if (count($data) > 0) 
        {
            foreach ($data as $row) 
            {
                $output->push([
                    'id' => $row->id,
                    'nom' => $row->nom,
                    'prenom' => $row->prenom,
                    'categorie' => $row->categorie, // <-- ajout
                ]);
            }
        } 
        else 
        {
            $output->push(['message' => 'No result']);
        }

        return $output->toJson();
    } 
}
   
    
public function store(Request $request)
    {
        $request->validate([
            'atelier_id' => 'required', 
            'journalier_id' => 'required',
            'heure' => 'required|numeric',
            'categorie' => 'required'
        ]);

        $taux_horaire = Tarif_Horaire::where('categorie', $request->categorie)->first();
        
        $heures_travaillees = $request->heure;
        $salaire = $taux_horaire->taux_horaire * $heures_travaillees;
        
        $data = $request->all();
        $data['salaire'] = $salaire;

        Pointage::create($data);

        return redirect()->route('pointages')->with(['success' => 'Payement added successfully']);
    }

public function getChefs_de_quart($atelierid = 0)
    {
        $chefData['data'] = Chef_de_quart::orderby("nom", "asc")
            ->select('id', 'nom')
            ->where('atelier_id', $atelierid)
            ->get();

        return response()->json($chefData);
    }


public function show(string $id) 
    {
        $pointagePayement = Pointage::findOrFail($id);
        return view('pointage.show', compact('pointagePayement'));
    }

    
    public function destroy(string $id) 
    {
        $pointage = Pointage::findOrFail($id);
        $pointage->delete();

        return redirect()->route('pointages')->with('success', 'Payement deleted successfully');
    }

public function filterpaye(Request $request)
    {
        $request->validate([
            'start_dates' => 'required|date',
            'end_dates' => 'required|date|after_or_equal:start_date',
            'atelier_id' => 'required', 
            'categorie' => 'required',
        ]);
    
        $start_dates = $request->start_dates;
        $end_dates = $request->end_dates;
        $atelier_id = $request->atelier_id;
        $categorie = $request->categorie;
    
        $ateliers['data'] = Atelier::orderby("nom", "asc")->select(['nom', 'id'])->get();
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray();
    
        $pointagePayement = Pointage::where('source_payement', 'payement')
                                        ->whereBetween('date', [$start_dates, $end_dates])
                                        ->when($atelier_id, function ($query) use ($atelier_id) {
                                            return $query->where('atelier_id', $atelier_id);
                                        })
                                        ->when($categorie, function ($query) use ($categorie) {
                                            return $query->where('categorie', $categorie);
                                        })
                                        ->orderBy('date')
                                        ->get();
    
        return view('pointage.index', compact('pointagePayement', 'start_dates', 'end_dates', 'ateliers', 'categories'));
    }
    



}