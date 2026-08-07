<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Atelier;
use App\Models\Pointage;
use App\Models\Journalier;
use Illuminate\Http\Request;
use App\Models\Chef_de_quart;
use App\Models\Tarif_Horaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class PointagesController extends Controller
{

    //2ieme Partie: PointageController pour la fiche de pointage et de payement du journalier par semaine    

    public function pointage()
    {
        $pointageRecapitulatif = Pointage::with(['atelier'])
            ->where('source', 'recapitulatif')
            ->orderBy('created_at', 'DESC') //ordre d'affichage des pointages par date de création: du plus récent au plus ancien
            ->get();
    
        return view('pointage.pointage', compact('pointageRecapitulatif'));
    }   


    public function recapitulatif() 
    {
        $ateliers['data'] = Atelier::orderby("nom", "asc")->select(['nom', 'id'])->get();
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray(); 


        return view("pointage.recapitulatif", compact('ateliers', 'categories'));
    }


    public function searchPointage(Request $request) 
    {
        if($request->ajax())
        {
 
            $data = Journalier::where('id','like','%'.$request->search.'%')
                ->orwhere('nom','like','%'.$request->search.'%')
                ->orwhere('prenom','like','%'.$request->search.'%')->get();

            $output = collect();

            if (count($data) > 0) 
                {

                    foreach ($data as $row) 
                    {
                        // Dernier pointage trouvé dans la liste des paiements pour ce journalier
                        $dernierPaiement = Pointage::where('journalier_id', $row->id)
                            ->where('source_payement', 'payement')
                            ->orderBy('created_at', 'DESC')
                            ->first();

                        $output->push([
                            'id' => $row->id,
                            'nom' => $row->nom,
                            'prenom' => $row->prenom,
                            'categorie' => $row->categorie,
                            'atelier_id' => $dernierPaiement->atelier_id ?? null,
                            'quart' => $dernierPaiement->quart ?? null,
                            'chef_de_quart' => $dernierPaiement->chef_de_quart ?? null,
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


    public function getChefs_de_quarts($atelierid = 0)
    {
        $chefData['data'] = Chef_de_quart::orderby("nom", "asc")
            ->select('id', 'nom')
            ->where('atelier_id', $atelierid)
            ->get();

        return response()->json($chefData);
    }

    public function getHeuresTravaillees(Request $request)
    {
        try {
            $dateDebut = $request->input('dateDebut');
            $dateFin = $request->input('dateFin');
            $journalierId = $request->input('journalierId');

            $pointagesSemaine = Pointage::where('journalier_id', $journalierId)
                ->whereBetween('date', [$dateDebut, $dateFin])
                ->get();

            $heuresTravailleesSemaine = $pointagesSemaine->sum('heure');

            return response()->json(['heuresTravaillees' => $heuresTravailleesSemaine]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storePointage(Request $request)
{
    $request->validate([
        'atelier_id' => 'required', 
        'journalier_id' => 'required',
        'heure' => 'required|numeric',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'categorie' => 'required',
    ]);

    $startOfWeek = $request->input('date_debut');
    $endOfWeek = $request->input('date_fin');

    // Recherche des pointages pour la semaine
    $pointageSemaine = Pointage::where('journalier_id', $request->journalier_id)
        ->whereBetween('date', [$startOfWeek, $endOfWeek])
        ->get();

    // Calcul des heures travaillées pour la semaine
    $heuresTravailleesSemaine = $pointageSemaine->sum('heure');

    // Récupération du taux horaire
    $tauxHoraire = Tarif_Horaire::where('categorie', $request->categorie)->first();

    // Calcul du salaire
    $salaire = $tauxHoraire->taux_horaire * $heuresTravailleesSemaine;

    // Enregistrement du pointage avec le salaire calculé
    $data = $request->all();
    $data['salaire'] = $salaire;
    Pointage::create($data);

    return redirect()->route('pointages.pointage')->with(['success' => 'Pointage added successfully']);
}


    public function showPointage(string $id) 
    {
        $pointageRecapitulatif = Pointage::findOrFail($id);
        return view('pointage.showPointage', compact('pointageRecapitulatif'));
    }

    public function destroyPointage(string $id) 
    {
        $pointage = Pointage::findOrFail($id);
        $pointage->delete();

        return redirect()->route('pointages.pointage')->with('success', 'Pointage deleted successfully');
    }

 
    public function index() 
    {

        $ateliers['data'] = Atelier::orderby("nom", "asc")->select(['nom', 'id'])->get();
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray();

        $pointageRecapitulatif = Pointage::with(['atelier'])
                                          ->where('source', 'recapitulatif')
                                          ->orderBy('created_at', 'DESC')
                                          ->get();

        return view('pointage.facturation', compact('ateliers','pointageRecapitulatif', 'categories'));
    }

    public function filter(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        
    ]);

    $start_date = $request->start_date;
    $end_date = $request->end_date;
    $atelier_id = $request->atelier_id;
    $categorie = $request->categorie;

    $ateliers['data'] = Atelier::orderby("nom", "asc")->select(['nom', 'id'])->get();
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray();

    $pointageRecapitulatif = Pointage::where('source', 'recapitulatif')
                                        ->whereBetween('date', [$start_date, $end_date])
                                        ->when($atelier_id, function ($query) use ($atelier_id) {
                                            return $query->where('atelier_id', $atelier_id);
                                        })
                                        ->when($categorie, function ($query) use ($categorie) {
                                            return $query->where('categorie', $categorie);
                                        })
                                        ->orderBy('date')
                                        ->get();

    
    return view('pointage.facturation', compact('pointageRecapitulatif', 'start_date', 'end_date', 'ateliers', 'categories'));
}

}