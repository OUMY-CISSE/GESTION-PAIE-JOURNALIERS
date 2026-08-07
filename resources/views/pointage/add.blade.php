@extends('layouts.app')

@section('title', 'Create Pointage')

@section('contents')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="border p-4 mb-4">
    <h1 class="mb-0">Ajouter une Fiche de Paiement</h1>
    <hr />

    <form action="{{ route('pointages.store') }}" method="POST">
        @csrf
        <input type="hidden" name="source_payement" value="payement">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="search">Rechercher</label>
                <div class="input-group">
                    <input type="text" name="search" id="search" placeholder="Enter search by ID, Name or Firstname" class="form-control" onfocus="this.value=''">
                </div>
                <div id="search_list"></div>
                <input type="hidden" name="journalier_id" id="journalier_id">
            </div>

            <div class="form-group col-md-6">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="Atelier_id">Atelier </label>
                <select id="atelier_id" name="atelier_id" class="form-control">
                    <option value='0'>Selectionner un atelier: </option>
                    @foreach($ateliers['data'] as $atelier)
                        <option value='{{ $atelier->id }}'>{{ $atelier->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="quart">Quart</label>
                <select class="form-control" id="quart" name="quart">
                    <option value="Matin">Matin</option>
                    <option value="Soir">Soir</option>
                    <option value="Nuit">Nuit</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="chef_de_quart">Chef de quart </label>
                <select id="chef_de_quart" name="chef_de_quart" class="form-control">
                    <option value='0'>Selectionner un chef de quart: </option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="categorie">Catégorie :</label>
                <select id="categorie" class="form-control" disabled>
                    <option value=""></option>
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="categorie" id="categorie_hidden">
            </div>

            <div class="form-group col-md-6">
                <label for="heure">Nombre d'heures travaillées</label>
                <input type="number" class="form-control" id="heure" name="heure">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="salaire">Salaire</label>
                <input type="text" class="form-control" id="salaire" name="salaire" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" placeholder="Date">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
        <div class="form-group">
            <a href="{{ route('pointages') }}" class="btn btn-dark">Return</a>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#search').on('keyup',function(){
            var query = $(this).val(); 

            if (query === '') {
                $('#search_list').html(''); 
                $('#nom').val(''); 
                $('#prenom').val(''); 
                $('#categorie').val('');
                $('#categorie_hidden').val('');
                return;
            }

            $.ajax({
                url: "search",
                type: "GET",
                data: {'search': query},
                dataType: 'json',
                success: function(data){ 
                    $('#search_list').html('');

                    if (data.length > 0) {
                        var firstResult = data[0];
                        $('#nom').val(firstResult.nom);
                        $('#prenom').val(firstResult.prenom);
                        $('#journalier_id').val(firstResult.id);

                        $('#categorie').val(firstResult.categorie);
                        $('#categorie_hidden').val(firstResult.categorie);
                    }
                }
            });
        });

        $(document).on('click', '#search_list li', function () {
            var selectedValue = $(this).text();
            $('#search').val(selectedValue);
            $('#search_list').html('');
        });
    });
</script>

<script type='text/javascript'>
    $(document).ready(function(){
        $('#atelier_id').change(function(){
            var id = $(this).val();

            $('#chef_de_quart').find('option').not(':first').remove();

            $.ajax({
                url: 'getChefs_de_quart/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    if(response['data'] != null){
                        $.each(response['data'], function(i, chef){
                            $('#chef_de_quart').append('<option value="'+ chef.nom +'">'+ chef.nom +'</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('form').submit(function (e) {
            if ($('#chef_de_quart').val() === '') {
                alert('Veuillez sélectionner un chef de quart.');
                e.preventDefault(); 
            }
        });
    });
</script>

@endsection