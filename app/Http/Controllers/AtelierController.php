<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use Illuminate\Http\Request;

class AtelierController extends Controller
{
    public function index()
    {
        $atelier = Atelier::orderBy('created_at', 'DESC')->get();
        return view('atelier.index', compact('atelier'));
    }

    public function add() 
    {
        return view("atelier/add");
    }

    public function store(Request $request)
    {
        
            $existingAtelier = Atelier::where('nom', $request->input('nom'))
                                            ->first();

            if ($existingAtelier) {
                
                return redirect()->route('ateliers')->with('error', 'Création Atelier Impossible');
            }
        Atelier::create($request->all());
        
        return redirect()->route('ateliers')->with('success', 'Atelier added successfully');
    }

    public function show(string $id) 
    {
        $atelier = Atelier::findOrFail($id);
        return view('atelier.show', compact('atelier'));
    }

    public function edit(string $id) 
    {
        $atelier = Atelier::findOrFail($id);
        return view('atelier.edit', compact('atelier'));
    }

    public function update(Request $request, string $id) 
    {
    
        $ateliers = Atelier::findOrFail($id);
        $ateliers->update($request->all());

        return redirect()->route('ateliers')->with('success', 'Atelier updated successfully');
    }

    public function destroy(string $id) 
    {
        $atelier = Atelier::findOrFail($id);
        $atelier->delete();

        return redirect()->route('ateliers')->with('success', 'Atelier deleted successfully');
    }
}
