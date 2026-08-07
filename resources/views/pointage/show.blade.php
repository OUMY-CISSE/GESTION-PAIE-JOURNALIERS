@extends('layouts.app')

@section('title', 'Show Payement')

@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <h1 class="mb-0">Detail Fiche Payement</h1>
    <hr />
    
        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" placeholder="nom" value="{{ $pointagePayement->journalier->nom }}" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" class="form-control" placeholder="prenom" value="{{ $pointagePayement->journalier->prenom }}" readonly>
            </div>

        </div>

        <div class="form-row">
           
            <div class="form-group col-md-6">
                <label for="Atelier_id">Atelier </label>
                <input type="text" name="atelier" class="form-control" placeholder="Atelier" value="{{ $pointagePayement->atelier->nom }}" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="chef_de_quart">Chef de quart </label>
                <input type="text" name="chef_de_quart" class="form-control" placeholder="chef_de_quart" value="{{ $pointagePayement->chef_de_quart }}" readonly>    
            </div>


        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                    <label class="form-label">Taux horaire</label>
                    <input type="decimal" name="taux_horaire" class="form-control" placeholder="taux horaire" value="{{ $pointagePayement->taux_horaire }}" readonly>
                </div> 

            <div class="form-group col-md-6">
                <label for="categorie">Catégorie :</label>
                <input type="text" name="categorie" class="form-control" placeholder="categorie" value="{{ $pointagePayement->categorie }}" readonly>
            </div>
            
        </div>

        <div class="form-row">
           
            <div class="form-group col-md-6">
                <label for="heure">Nombre d'heures travaillées</label>
                <input type="text" name="heure" class="form-control" placeholder="heure" value="{{ $pointagePayement->heure }}" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="quart">Quart</label>
                <input type="text" name="quart" class="form-control" placeholder="quart" value="{{ $pointagePayement->quart }}" readonly>
            </div>

            
                
        </div>

      <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="salaire">Salaire</label>
                    <input type="text" name="salaire" class="form-control" placeholder="salaire" value="{{ $pointagePayement->salaire }}" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="date">Date:</label>
                    <input type="date" name="date" class="form-control" placeholder="date" value="{{ $pointagePayement->date }}" readonly>
                </div>

        </div>

        <div class="form-group">
            <a href="{{ route('pointages') }}" class="btn btn-dark">Return</a>
        </div>
    


@endsection