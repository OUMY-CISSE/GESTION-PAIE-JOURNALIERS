@extends('layouts.app')
  
@section('title', 'Edit Chef de quart')
    
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container border p-4">
    <h1 class="mb-0">Edit Chef de quart</h1>
    <hr />
    <form action="{{ route('chef_de_quarts.update', $chef_de_quart->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ $chef_de_quart->nom }}" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Matricule :</label>
            <div class="col-sm-10">
                <input type="text" name="matricule" class="form-control" placeholder="Matricule" value="{{ $chef_de_quart->matricule }}" >
            </div>
        </div>
        <div class="form-group row">
    <label class="col-sm-2 col-form-label">Atelier :</label>
    <div class="col-sm-10">
        <select name="atelier_id" class="form-control" required>
            <option value="">Sélectionnez un atelier</option>
            @foreach($ateliers as $atelier)
                <option value="{{ $atelier->id }}">{{ $atelier->nom }}</option>
            @endforeach
        </select>
    </div>
</div>

        <div class="row">
            <div class="form-group">
                <button class="btn btn-warning">Update</button>
            </div>
            <div class="form-group">
                <a href="{{ route('chef_de_quarts') }}" class="btn btn-dark">Return</a>
            </div>
        </div>
    </form>
</div>
@endsection
