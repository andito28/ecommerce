@extends('template.admin')

@section('title')
    Dashboard | Categori
@endsection

@section('content')
    <div class="col col-md-12">

        <div class="card card-shadow">

            <div class="card-header">
                <div class="card-title">HALAMAN CATEGORI</div>
            </div>

            <div class="card-header bg-white pb-10 pt-30">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tombol-tambah"> Add Categori</a>
            </div>

            <div class="card-body">

                <table class="table table-bordered" id="table-categori">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Categori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>

    </div>


     {{-- modal add and edit --}}
     <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                @csrf
                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="title" class="col-sm-12 control-label">Categori</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="categori" name="nameProduct" value="">
                                        <span id="nameError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan" value="create">Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add and edit --}}


    <script>

        $(function(){
            $('#table-categori').DataTable({
                processing:true,
                serverside:true,
                ajax: "{{route('dataCategori')}}",
                column : [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action',name: 'action'}
                ]
            });
        });

        //ketika tombol tambah di tekan
        $('#tombol-tambah').on('click',function(){
            $('#id').val("");
            $('#tambah-edit-modal').trigger('reset');
            $('#tambah-edit-modal').modal('show');
        });


    </script>
@endsection
