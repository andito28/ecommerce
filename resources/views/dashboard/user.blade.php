@extends('template.admin')

@section('title')
    Dashboard | Users
@endsection


@section('content')
<div class="col col-md-12">
    <div class="card card-shadow">
        {{-- <div class="card-header bg-primary text-white">HALAMAN USERS</div> --}}

        {{-- <div class="card-header bg-white pb-10 pt-30">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tombol-tambah"> Add Product</a>
        </div> --}}

        <div class="card-body">

            <div class="table-responsive">
            <table class="table table-bordered dt-responsive" id="table-users">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                </thead>
            </table>
        </div>

            {{-- modal delete --}}
            {{-- <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PERHATIAN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Hapus Product, apakah anda yakin?</p>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger btn-sm" name="tombol-hapus" id="tombol-hapus">Hapus Data</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- end modal delete --}}

                </div>
            </div>
    </div>
</div>

<script>
    $(function(){
        $('#table-users').DataTable({
            processing : true,
            serverSide : true,
            responsive : true,
            ajax : "{{route('dataUsers')}}",
            columns : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name' , name: 'name'},
                {data: 'address' , name: 'address'},
                {data: 'phone' , name: 'phone'}

            ]
        })
    })
</script>


@endsection


