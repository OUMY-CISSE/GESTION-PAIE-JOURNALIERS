<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use App\Models\Chef_de_quart;
use Illuminate\Http\Request;

class Chef_de_quartController extends Controller
{
    public function index()
    {
        $chef_de_quart = Chef_de_quart::with('atelier')->orderBy('created_at', 'DESC')->get();
        return view('chef_de_quart.index', compact('chef_de_quart'));
    }

    

    public function add()
    {
        $ateliers = Atelier::all();
        return view('chef_de_quart.add', compact('ateliers'));
    }


    public function store(Request $request)
    {
        $existingChef_de_quart = Chef_de_quart::where('matricule', $request->input('matricule'))
                                        ->first();

        if ($existingChef_de_quart) {
            
            return redirect()->route('chef_de_quarts')->with('error', 'Création du Chef de quart Impossible');
        }

        Chef_de_quart::create($request->all());
        return redirect()->route('chef_de_quarts')->with('success', 'Chef de quart added successfully');

    }

    public function show(string $id) 
    {
        $chef_de_quart = Chef_de_quart::findOrFail($id);
        return view('chef_de_quart.show', compact('chef_de_quart'));
    }


    public function edit(string $id) 
    {
        $ateliers = Atelier::all();
        $chef_de_quart = Chef_de_quart::findOrFail($id);
        return view('chef_de_quart.edit', compact('chef_de_quart', 'ateliers'));
    }


public function update(Request $request, string $id) 
    {
    
        $chef_de_quarts = Chef_de_quart::findOrFail($id);
        $chef_de_quarts->update($request->all());

        return redirect()->route('chef_de_quarts')->with('success', 'chef de quart updated successfully');
    }

public function destroy(string $id) 
    {
        $chef_de_quart = Chef_de_quart::findOrFail($id);
        $chef_de_quart->delete();

        return redirect()->route('chef_de_quarts')->with('success', 'Chef de quart deleted successfully');
    }

}
