<?php

namespace App\Http\Controllers;

use App\Models\Tarif_Horaire;
use Illuminate\Http\Request;

class Tarif_HoraireController extends Controller
{
    public function index() 
    {
        $tarif_horaire = Tarif_Horaire::orderBy('created_at', 'DESC')->get();
        return view('tarif_horaire.index', compact('tarif_horaire'));
    }

    public function add() 
    {
        return view('tarif_horaire.add');
    }

    public function store(Request $request)
    {
        
            $existingTarif_horaire = Tarif_Horaire::where('categorie', $request->input('categorie'))
                                            ->first();

            if ($existingTarif_horaire) {
                
                return redirect()->route('tarif_horaires')->with('error', 'Création Tarif Horaire Impossible');
            }
        Tarif_Horaire::create($request->all());
        
        return redirect()->route('tarif_horaires')->with('success', 'Tarif Horaire added successfully');
    }

    public function show(string $id) 
    {
        $tarif_horaire = Tarif_Horaire::findOrFail($id);
        return view('tarif_horaire.show', compact('tarif_horaire'));
    }

    public function edit(string $id) 
    {
        $tarif_horaire = Tarif_Horaire::findOrFail($id);
        return view('tarif_horaire.edit', compact('tarif_horaire'));
    }

    public function update(Request $request, string $id) 
    {
    
        $tarif_horaires = Tarif_Horaire::findOrFail($id);
        $tarif_horaires->update($request->all());

        return redirect()->route('tarif_horaires')->with('success', 'Tarif Horaire updated successfully');
    }

    public function destroy(string $id) 
    {
        $tarif_horaire = Tarif_Horaire::findOrFail($id);
        $tarif_horaire->delete();

        return redirect()->route('tarif_horaires')->with('success', 'Tarif Horaire deleted successfully');
    }
}
