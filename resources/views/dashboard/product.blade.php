@extends('template.admin')

<style>
    td{
        font-size: 14px;
    }
    th{
        font-size:15px;
    }
</style>

@section('title')
Product
@endsection

@section('content')
    <div class="col cil-md-12">
        <div class="card card-shadow">
            <div class="card-header">HALAMAN PRODUCT</div>
            <div class="card-body">

                <table class="table table-bordered" id="table-product">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>images</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
 <!-- jQuery -->
 <script src="//code.jquery.com/jquery.js"></script>
 <!-- DataTables -->
 <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script>
      $(function() {
                $('#table-product').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{route("dataProduct")}}',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'price', name: 'price' },
                        { data: 'desc', name: 'desc' },
                        { data: 'images', name: 'images'}
                    ]
                });
            });
</script>
