@extends('layouts.app')

@section('title', 'Create journaliers')

@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="border p-4 mb-4">
    <h1 class="mb-0">Add Journalier</h1>
    <hr />
    
    <form action="{{ route('journaliers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group mb-3 col-6">
                <label for="categorie">Catégorie :</label>
                <select name="categorie" class="form-control">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group mb-3 col-6">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="date_naissance">Date Naissance :</label>
                <input type="date" name="date_naiss" class="form-control" placeholder="Date Naissance">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group mb-3 col-6">
                <label for="lieu_naissance">Lieu Naissance :</label>
                <input type="text" name="lieu_naiss" class="form-control" placeholder="Lieu Naissance">
            </div>

            <div class="form-group mb-3 col-6">
                <label for="cin">CIN :</label>
                <input type="text" name="CIN" class="form-control" placeholder="CIN">
            </div>

        </div>
        
            
            <div class="form-group ">
                <label for="date_creation">Date Creation :</label>
                <input type="date" name="date_creation" class="form-control" >
            </div>
    
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
        <div class="form-group">
            <a href="{{ route('journaliers') }}" class="btn btn-dark">Return</a>
        </div>
    </form>
</div>

<script>
    document.querySelector('input[name="date_naiss"]').addEventListener('change', function() {
        var dob = new Date(this.value);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        if (today < new Date(today.getFullYear(), dob.getMonth(), dob.getDate())) {
            age--;
        }
        document.querySelector('input[name="age"]').value = age;
    });
</script>

@endsection
