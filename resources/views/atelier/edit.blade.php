@extends('layouts.app')
  
@section('title', 'Edit Atelier')
    
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container border p-4">
    <h1 class="mb-0">Edit Atelier</h1>
    <hr />
    <form action="{{ route('ateliers.update', $atelier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ $atelier->nom }}" >
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
            <div class="form-group">
                <a href="{{ route('ateliers') }}" class="btn btn-dark">Return</a>
            </div>
        </div>
    </form>
</div>
@endsection
