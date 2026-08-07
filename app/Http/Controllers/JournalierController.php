<?php

namespace App\Http\Controllers;
use App\Models\Tarif_Horaire;
use Illuminate\Http\Request;
use App\Models\Journalier;
use Carbon\Carbon;

class JournalierController extends Controller
{
    public function index()
    {
        $results = Journalier::orderBy('created_at', 'DESC')->get();
        return view('journalier.index', compact('results'));
    }
    
    public function add()
    {
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray(); 
        return view("journalier.add", compact('categories'));
    }

    public function store(Request $request)
    {
        $existingJournalier = Journalier::where('CIN', $request->input('CIN'))->first();

        if ($existingJournalier) {
            return redirect()->route('journaliers')->with('error', 'Création du journalier Impossible');
        }

        $dateNaissance = Carbon::parse($request->input('date_naiss'));
        $age = $dateNaissance->diffInYears(now());

        $request->merge(['age' => $age]);

        Journalier::create($request->all());
        
        return redirect()->route('journaliers')->with('success', 'Journalier added successfully');
    }

    public function show(string $id) 
    {
        $journalier = Journalier::findOrFail($id);
        return view('journalier.show', compact('journalier'));
    }

    public function edit(string $id) 
    {
        $categories = Tarif_Horaire::pluck('categorie', 'id')->toArray();
        $journalier = Journalier::findOrFail($id);
        return view('journalier.edit', compact('journalier', 'categories'));
    }

    public function update(Request $request, string $id) 
    {
        $dateNaissance = Carbon::parse($request->input('date_naiss'));
        $age = $dateNaissance->diffInYears(now());
        $request->merge(['age' => $age]);

        $journalier = Journalier::findOrFail($id);

        $journalier->update($request->all());
       
        $tarifHoraire = Tarif_Horaire::find($request->input('categorie'));
        if ($tarifHoraire) {
            $journalier->taux_horaire = $tarifHoraire->taux_horaire;
            $journalier->save();
        }

        return redirect()->route('journaliers')->with('success', 'Journalier updated successfully');
    }

    public function destroy(string $id) 
    {
        $journalier = Journalier::findOrFail($id);
        $journalier->delete();

        return redirect()->route('journaliers')->with('success', 'Journalier deleted successfully');
    }


    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        if (preg_match('/^id:(\d+)$/i', $searchQuery, $matches)) {
            
            $results = Journalier::where('id', '=', $matches[1])->get();
        } elseif (preg_match('/^categorie:(\S+)$/i', $searchQuery, $matches)) {
            
            $results = Journalier::where('categorie', '=', $matches[1])->get();
        } else {
            
            $results = Journalier::where(function ($query) use ($searchQuery) {
                $query->where('nom', 'LIKE', "%$searchQuery%")
                    ->orWhere('prenom', 'LIKE', "%$searchQuery%")
                    ->orWhere('CIN', 'LIKE', "%$searchQuery%")
                    ->orWhere('date_creation', 'LIKE', "%$searchQuery%");
            })->orWhere('categorie', '=', $searchQuery)->get();
        }

        return view('journalier.index', compact('results'));
    }












}
