@extends('layouts.app')
  
@section('title', 'Home Pointage')
  
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" >

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Liste des Paiements</h1>
        <a href="{{ route('pointages.add') }}" class="btn btn-dark">Ajouter des Paiements</a>
    </div>
    

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif    
    
    <hr />
    
            <form action="{{ route('pointages.filterpaye') }}" method="GET">
                <div class="row">
                        <div class="col-md-3">
                            <label for="start_dates" class="form-label">Date de début</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="start_dates_icon"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="start_dates" class="form-control" id="start_dates">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="end_dates" class="form-label">Date de fin</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="end_dates_icon"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="end_dates" class="form-control" id="end_dates">
                            </div>
                        </div>
        
                        <div class="col-md-3">
                            <label for="atelier_id" class="form-label">Atelier</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="atelier_icon"><i
                                        class="fas fa-building"></i></span>
                                <select id="atelier_id" name="atelier_id" class="form-control">
                                    <option value='0'>Sélectionner un atelier</option>
                                    @foreach($ateliers['data'] as $atelier)
                                    <option value='{{ $atelier->id }}'>{{ $atelier->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="categorie_icon"><i
                                        class="fas fa-tag"></i></span>
                                <select name="categorie" class="form-control">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-success">Filtrer</button>
                            <a href="{{ route('pointages') }}" class="btn btn-warning">Réinitialiser</a>
                        </div>
                </div>
                    
            </form>

            <br />

                        <table class="table table-hover" id="paye" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                <th>ID</th>
                                <th>Catégorie</th>
                                <th>Atelier</th>
                                <th>Quart</th>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>DateCreation</th>
                                <th>Chef de quart</th>
                                <th>Heure Travaillée</th>
                                <th>taux horaire</th>
                                <th>Salaire</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pointagePayement->count() > 0 )
                                    @foreach($pointagePayement as $rs)
                                        <tr>
                                        <td class="align-middle">{{ $rs->journalier->id }}</td>
                                        <td class="align-middle">{{ $rs->categorie }}</td>
                                        <td class="align-middle">{{ $rs->atelier->nom }}</td>
                                        <td class="align-middle">{{ $rs->quart }}</td>
                                        <td class="align-middle">{{ $rs->journalier->prenom }}</td>
                                        <td class="align-middle">{{ $rs->journalier->nom }}</td>
                                        <td class="align-middle">{{ $rs->date }}</td>  
                                        <td class="align-middle">{{ $rs->chef_de_quart }}</td>
                                        <td class="align-middle">{{ $rs->heure }} H</td>
                                        <td class="align-middle">{{ $rs->taux_horaire }}</td>
                                        <td class="align-middle">{{ $rs->salaire }}</td>
                                            <td class="align-middle">
                                                <div class="btn-group" role="group">
                                                    <button id="actionDropdown" type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Menus
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                                        <a class="dropdown-item" href="{{ route('pointages.show', $rs->id) }}">Detail</a>
                                                        <form action="{{ route('pointages.destroy', $rs->id) }}" method="POST" type="button" class="" onsubmit="return confirm('Delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item btn-delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="5">Pointage Journalier not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table> 
                    
                       
   
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#paye');
    </script>

@endsection        