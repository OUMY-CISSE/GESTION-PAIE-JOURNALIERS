@extends('layouts.app')
  
@section('title', 'Edit Tarif Horaire')
    
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container border p-4">
    <h1 class="mb-0">Edit Tarif Horaire</h1>
    <hr />
    <form action="{{ route('tarif_horaires.update', $tarif_horaire->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Categorie :</label>
            <div class="col-sm-10">
                <input type="text" name="categorie" class="form-control" placeholder="categorie" value="{{ $tarif_horaire->categorie }}" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Taux horaire :</label>
            <div class="col-sm-10">
                <input type="decimal" name="taux_horaire" class="form-control" placeholder="taux_horaire" value="{{ $tarif_horaire->taux_horaire }}" >
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button class="btn btn-warning">Update</button>
            </div>
            <div class="form-group">
                <a href="{{ route('tarif_horaires') }}" class="btn btn-dark">Return</a>
            </div>
        </div>
    </form>
</div>
@endsection
