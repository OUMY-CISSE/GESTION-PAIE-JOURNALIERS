@extends('layouts.app')
  
@section('title', 'Show Journalier')
  
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <h1 class="mb-0">Detail Journalier</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Categorie</label>
            <input type="text" name="categorie" class="form-control" placeholder="categorie" value="{{ $journalier->tarifHoraire->categorie }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Prenom</label>
            <input type="text" name="prenom" class="form-control" placeholder="prenom" value="{{ $journalier->prenom }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" placeholder="nom" value="{{ $journalier->nom }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Date Naissance</label>
            <input type="date" name="date_naiss" class="form-control" placeholder="date naissance" value="{{ $journalier->date_naiss }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Lieu Naissance</label>
            <input type="text" name="lieu_naiss" class="form-control" placeholder="lieu naissance" value="{{ $journalier->lieu_naiss }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Age</label>
            <input type="text" name="age" class="form-control" placeholder="age" value="{{ $journalier->age }}" readonly>
        </div>   
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">CIN</label>
            <input type="text" name="CIN" class="form-control" placeholder="CIN" value="{{ $journalier->CIN }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Taux horaire</label>
            <input type="decimal" name="taux_horaire" class="form-control" placeholder="taux horaire" value="{{ $journalier->taux_horaire }}" readonly>
        </div>   
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Date Creation</label>
            <input type="date" name="date_creation" class="form-control" placeholder="date creation" value="{{ $journalier->date_creation }}" readonly>
        </div>   
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $journalier->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $journalier->updated_at }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <a href="{{ route('journaliers') }}" class="btn btn-dark">Return</a>
    </div>
@endsection    