@extends('layouts.app')
  
@section('title', 'Home Pointage')
  
@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" >


    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Tableau Recapitulatif des Paiements</h1>
        <div class="float-right">
        <a href="{{ route('pointages.recapitulatif') }}" class="btn btn-dark">Add Pointage</a>
        <a href="{{ route('pointages.facturation') }}" class="btn btn-dark ml-0">Facturation</a>
    </div>
    </div>

    <hr />
    
    
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif   

    <div class="table-responsive">
        <table class="table table-hover" id="recap" style="width:100%">
            <thead class="table-primary">
                <tr>
                <th>ID</th>
                <th>Catégorie</th>
                <th>Atelier</th>
                <th>Quart</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>DateCreation Recapitulatif Salaire</th>
                <th>Chef de quart</th>
                <th>Heure totale Travaillée</th>
                <th>taux horaire</th>
                <th>Salaire hebdomadaire</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($pointageRecapitulatif->count() > 0 )
                    @foreach($pointageRecapitulatif as $rs)
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
                                    <a class="dropdown-item" href="{{ route('pointages.showPointage', $rs->id) }}">Detail</a>
                                    <form action="{{ route('pointages.destroyPointage', $rs->id) }}" method="POST" type="button" class="" onsubmit="return confirm('Delete?')">
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
                        <td class="text-center" colspan="12">Pointage Journalier not found</td>
                    </tr>
                        
                @endif
            </tbody>

        </table>
    </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
            let table = new DataTable('#recap');
        </script>
           
@endsection