@extends('layouts.app')
  
@section('title', 'Show Atelier')
  
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container border p-4">
    <h1 class="mb-4">Détail Atelier</h1>
    <form class="form-horizontal">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ $atelier->nom }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Create At :</label>
            <div class="col-sm-10">
                <input type="text" name="created_at" class="form-control" placeholder="Créé le" value="{{ $atelier->created_at }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Update At :</label>
            <div class="col-sm-10">
                <input type="text" name="updated_at" class="form-control" placeholder="Modifié le" value="{{ $atelier->updated_at }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="{{ route('ateliers') }}" class="btn btn-dark">Return</a>
            </div>
        </div>
    </form>
</div>
@endsection
