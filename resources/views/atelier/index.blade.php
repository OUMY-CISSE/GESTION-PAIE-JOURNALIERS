@extends('layouts.app')
  
@section('title', 'Home Ateliers')
  
@section('contents')

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" >

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Liste des Ateliers</h1>
        <a href="{{ route('ateliers.add') }}" class="btn btn-dark">Add Atelier</a>
    </div>
    <hr />  
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif    
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif  
    <table class="table table-hover" id="atelier" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($atelier->count() > 0 )
                @foreach($atelier as $rs)
                    <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->nom }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group">
                                <button id="actionDropdown" type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menus
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                    <a class="dropdown-item" href="{{ route('ateliers.show', $rs->id) }}">Detail</a>
                                    <a class="dropdown-item" href="{{ route('ateliers.edit', $rs->id) }}">Edit</a>
                                    <form action="{{ route('ateliers.destroy', $rs->id) }}" method="POST" type="button" class="" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item btn-delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Atelier not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#atelier');
    </script>

        

@endsection        