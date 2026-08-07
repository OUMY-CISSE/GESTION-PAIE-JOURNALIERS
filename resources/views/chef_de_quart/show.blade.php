@extends('layouts.app')
  
@section('title', 'Show Chef de quart')
  
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container border p-4">
    <h1 class="mb-4">Détail Chef de quart</h1>
    <form class="form-horizontal">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ $chef_de_quart->nom }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Matricule :</label>
            <div class="col-sm-10">
                <input type="text" name="matricule" class="form-control" placeholder="Matricule" value="{{ $chef_de_quart->matricule }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Atelier :</label>
            <div class="col-sm-10">
                <input type="text" name="atelier" class="form-control" placeholder="Atelier" value="{{ $chef_de_quart->atelier->nom }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Create At :</label>
            <div class="col-sm-10">
                <input type="text" name="created_at" class="form-control" placeholder="Créé le" value="{{ $chef_de_quart->created_at }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Update At :</label>
            <div class="col-sm-10">
                <input type="text" name="updated_at" class="form-control" placeholder="Modifié le" value="{{ $chef_de_quart->updated_at }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="{{ route('chef_de_quarts') }}" class="btn btn-dark">Return</a>
            </div>
        </div>
    </form>
</div>
@endsection
