@extends('layouts.app')
  
@section('title', 'Show Tarif Horaire')
  
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container border p-4">
    <h1 class="mb-4">Détail Tarif Horaire</h1>
    <form class="form-horizontal">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Categorie :</label>
            <div class="col-sm-10">
                <input type="text" name="categorie" class="form-control" placeholder="categorie" value="{{ $tarif_horaire->categorie }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Taux Horaire :</label>
            <div class="col-sm-10">
                <input type="decimal" name="taux_horaire" class="form-control" placeholder="taux_horaire" value="{{ $tarif_horaire->taux_horaire }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Create At :</label>
            <div class="col-sm-10">
                <input type="text" name="created_at" class="form-control" placeholder="Créé le" value="{{ $tarif_horaire->created_at }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Update At :</label>
            <div class="col-sm-10">
                <input type="text" name="updated_at" class="form-control" placeholder="Modifié le" value="{{ $tarif_horaire->updated_at }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="{{ route('tarif_horaires') }}" class="btn btn-dark">Return</a>
            </div>
        </div>
    </form>
</div>

@endsection
