<!DOCTYPE html>
<html>
<head>
    <title>FICHE DE PAIE DES JOURNALIERS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>
<body>
    <br />
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title" align="center">Import & Export File in Laravel</h1>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form class="row g-3" action="{{ route('excels.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
                        <label class="visually-hidden">Excel</label>
                        <input type="file" class="form-control" name="excel_file">
                    </div>

                    <div class="col-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mb-3">Upload Excel File</button>
                    </div>

                    @error('excel_file')
                        <span class="col-md-4 text-danger">{{ $message }}</span>
                    @enderror
                </form>

                <hr>

                <form action="{{ route('excels.destroy') }}" method="POST" type="button" class="" onsubmit="return confirm('Delete?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                </form>

                <hr>

                <br />

                <form action="{{ route('excels.filtertableau') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="start_dates" class="form-label">Start Date</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="start_dates_icon"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="start_dates" class="form-control" id="start_dates">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="end_dates" class="form-label">End Date</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text text-dark" id="end_dates_icon"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="end_dates" class="form-control" id="end_dates">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <a href="{{ route('excels') }}" class="btn btn-warning">Reset</a>
                            <a href="{{ route('journaliers') }}" class="btn btn-dark">Return</a>
                        </div>
                    </div>
                </form>

                <br />

                <hr />
                <br />

                <table class="table table-hover" id="tableau" style="width:100%">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Categorie</th>
                            <th>Atelier</th>
                            <th>Quart</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>DateCreation</th>
                            <th>Chef de quart</th>
                            <th>Heure Travailée</th>
                            <th>Taux Horaire</th>
                            <th>Salaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($excels as $rs)
                            <tr>
                                <td>{{ $rs->id }}</td>
                                <td>{{ $rs->categorie }}</td>
                                <td>{{ $rs->atelier }}</td>
                                <td>{{ $rs->quart }}</td>
                                <td>{{ $rs->prenom }}</td>
                                <td>{{ $rs->nom }}</td>
                                <td>{{ $rs->date }}</td>
                                <td>{{ $rs->chef_de_quart }}</td>
                                <td>{{ $rs->heure }}</td>
                                <td>{{ $rs->taux_horaire }}</td>
                                <td>{{ $rs->salaire }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $.fn.dataTable.ext.errMode = 'none';

        $(document).ready(function() {
            $('#tableau').DataTable( {
                dom: 'Bfrtip',
                language: {
                    emptyTable: "No Data Found"
                },
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
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
                    }
                ]
            } );
        } );
    </script>
</body>
</html>
