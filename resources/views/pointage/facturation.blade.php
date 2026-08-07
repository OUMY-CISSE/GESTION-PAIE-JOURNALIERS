<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fiche de Paie</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">FICHE DE PAIE DU
                    {{ $start_date ?? '__/__/__' }} AU {{ $end_date ?? '__/__/__' }}
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/filter">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="start_date_icon"><i
                                        class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="start_date" class="form-control" id="start_date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="end_date_icon"><i
                                        class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="end_date" class="form-control" id="end_date">
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
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <a href="{{ route('pointages.facturation') }}" class="btn btn-warning">Reset</a>
                            <a href="{{ route('pointages.pointage') }}" class="btn btn-dark">Return</a>
                        </div>
                    </div>
                </form>

                <br />



                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless display nowrap" id="records" style="width:100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Chef de Quart</th>
                                        <th>Heure totale Travaillée</th>
                                        <th>Salaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($pointageRecapitulatif->count() > 0)
                                    @foreach($pointageRecapitulatif as $rs)
                                    <tr>
                                        <td class="align-middle">{{ $rs->journalier->id }}</td>
                                        <td class="align-middle">{{ $rs->journalier->prenom }}</td>
                                        <td class="align-middle">{{ $rs->journalier->nom }}</td>
                                        <td class="align-middle">{{ $rs->chef_de_quart }}</td>
                                        <td class="align-middle">{{ $rs->heure }} H</td>
                                        <td class="align-middle">{{ $rs->salaire }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="6">No records found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $.fn.dataTable.ext.errMode = 'none';

        $(function () {
            let table = new DataTable('#records', {
                dom: 'Bfrtip',
                language: {
                    emptyTable: "No Data Found"
                },
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'FICHE DE PAIE DES JOURNALIERS'
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'FICHE DE PAIE DES JOURNALIERS'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'FICHE DE PAIE DES JOURNALIERS'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'FICHE DE PAIE DES JOURNALIERS',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function (doc) {

                            doc.pageMargins = [15, 40, 15, 30];

                            doc.content[0].text = 'FICHE DE PAIE DES JOURNALIERS';
                            doc.content[0].alignment = 'center';
                            doc.content[0].fontSize = 17;
                            doc.content[0].bold = true;
                            doc.content[0].color = '#000000';
                            doc.content[0].margin = [0, 0, 0, 4];

                            doc.content.splice(1, 0, {
                                text: 'DATE DE CREATION : ' + new Date().toLocaleDateString('fr-FR'),
                                alignment: 'center',
                                fontSize: 9,
                                color: '#666666',
                                margin: [0, 0, 0, 12]
                            });

                            var table = doc.content[doc.content.length - 1];
                            table.table.headerRows = 1;

                            var nbCols = table.table.body[0].length;
                            table.table.widths = new Array(nbCols).fill('*');

                            table.layout = {
                                fillColor: function (rowIndex) {
                                    if (rowIndex === 0) {
                                        return '#1a5ccd';
                                    }
                                    return (rowIndex % 2 === 0) ? '#F2F5FA' : null;
                                },
                                hLineWidth: function () { return 0.5; },
                                vLineWidth: function () { return 0.5; },
                                hLineColor: function () { return '#CCCCCC'; },
                                vLineColor: function () { return '#CCCCCC'; },
                                paddingTop: function () { return 5; },
                                paddingBottom: function () { return 5; },
                                paddingLeft: function () { return 4; },
                                paddingRight: function () { return 4; }
                            };

                            table.table.body.forEach(function (row, i) {
                                row.forEach(function (cell) {
                                    cell.fontSize = 9;
                                    cell.alignment = 'center';
                                    if (i === 0) {
                                        cell.color = '#FFFFFF';
                                        cell.bold = true;
                                        cell.fontSize = 9.5;
                                    } else {
                                        cell.color = '#222222';
                                    }
                                });
                            });

                            doc.footer = function (currentPage, pageCount) {
                                return {
                                    columns: [
                                        {
                                            text: 'Généré le ' + new Date().toLocaleString('fr-FR'),
                                            alignment: 'left',
                                            fontSize: 7,
                                            color: '#999999',
                                            margin: [20, 0, 0, 0]
                                        },
                                        {
                                            text: 'Page ' + currentPage.toString() + ' / ' + pageCount,
                                            alignment: 'right',
                                            fontSize: 7,
                                            color: '#999999',
                                            margin: [0, 0, 20, 0]
                                        }
                                    ]
                                };
                            };

                            doc.defaultStyle = doc.defaultStyle || {};
                            doc.defaultStyle.fontSize = 8;
                        }
                    },
                ]
            });
        });
    </script>

</body>

</html>