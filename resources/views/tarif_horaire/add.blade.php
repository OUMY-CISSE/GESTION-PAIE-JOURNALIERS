@extends('layouts.app')

@section('title', 'Create Tarif Horaire')

@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="border p-4 mb-4">
    <h1 class="mb-0">Add Tarif Horaire</h1>
    <hr />
    <form action="{{ route('tarif_horaires.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="categorie">Categorie:</label>
            <input type="text" name="categorie" class="form-control" placeholder="categorie" required>
        </div>
        <div class="form-group">
            <label for="taux_horaire">Taux Horaire:</label>
            <input type="decimal" name="taux_horaire" class="form-control" placeholder="taux horaire" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
        <div class="form-group">
            <a href="{{ route('tarif_horaires') }}" class="btn btn-dark">Return</a>
        </div> 
    </form>
</div>



@endsection
