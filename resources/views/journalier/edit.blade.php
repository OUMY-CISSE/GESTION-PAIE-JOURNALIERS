@extends('layouts.app')
  
  @section('title', 'Edit Journalier')
    
  @section('contents')

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <h1 class="mb-0">Edit Journalier</h1>
      <hr />
    <form action="{{ route('journaliers.update', $journalier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="form-group mb-3 col-6">
                <label for="categorie">Catégorie :</label>
                <select name="categorie" class="form-control">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        <div class="col mb-3">
            <label class="form-label">Prenom</label>
            <input type="text" name="prenom" class="form-control" placeholder="prenom" value="{{ $journalier->prenom }}">
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" placeholder="nom" value="{{ $journalier->nom }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Date Naissance</label>
            <input type="date" name="date_naiss" class="form-control" placeholder="date naissance" value="{{ $journalier->date_naiss }}">
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Lieu Naissance</label>
            <input type="text" name="lieu_naiss" class="form-control" placeholder="lieu naissance" value="{{ $journalier->lieu_naiss }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Age</label>
            <input type="text" name="age" class="form-control" placeholder="age" value="{{ $journalier->age }}">
        </div>   
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">CIN</label>
            <input type="text" name="CIN" class="form-control" placeholder="CIN" value="{{ $journalier->CIN }}">
        </div>
         
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Date Creation</label>
            <input type="date" name="date_creation" class="form-control" placeholder="date creation" value="{{ $journalier->date_creation }}" readonly>
        </div>   
    </div>
    <div class="row">
        <div class="form-group">
             <button class="btn btn-warning">Update</button>
        </div>
        <div class="form-group">
            <a href="{{ route('journaliers') }}" class="btn btn-dark">Return</a>
        </div>    
    </div>    
        
    </form>
  @endsection    