<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LaraPost</title>
        {{-- import file bootstrap  --}}
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    </head>

    <body>
        <br>
        <div class="container">
            <nav class="navbar navbar-dark bg-primary">
                <div class="container">
                    <h1>Latihan Datatable Laravel</h1>
                </div>
            </nav>
            <br><br>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>
            $(function() {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: 'mahasiswa/json',
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        { data: 'nama_mahasiswa', name: 'name' },
                        { data: 'jk', name: 'jk' },
                        { data: 'alamat', name: 'alamat' },
                        { data: 'no_telp', name: 'no_telp'},
                        { data: 'jurusan', name: 'jurusan' }
                    ]
                });
            });
        </script>
    </body>

    </html>
