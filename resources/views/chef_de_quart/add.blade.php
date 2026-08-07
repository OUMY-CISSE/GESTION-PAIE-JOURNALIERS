@extends('layouts.app')

@section('title', 'Create Chef de quart')

@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="border p-4 mb-4">
    <h1 class="mb-0">Add Chef de quart</h1>
    <hr />
    <form action="{{ route('chef_de_quarts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom Complet:</label>
            <input type="text" name="nom" class="form-control" placeholder="Nom" required>
        </div>
        <div class="form-group">
            <label for="matricule">Matricule:</label>
            <input type="text" name="matricule" class="form-control" placeholder="matricule" required>
        </div>
        <div class="form-group">
            <label for="atelier_id">Atelier :</label>
            <select name="atelier_id" class="form-control" required>
                <option value="">Sélectionnez un atelier</option>
                @foreach($ateliers as $atelier)
                    <option value="{{ $atelier->id }}">{{ $atelier->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
@endsection
