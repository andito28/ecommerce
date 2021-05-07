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

                <div class="table-responsive">
                <table class="table table-bordered dt-responsive" id="table-categori" style="width:100%">
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

    </div>


     {{-- modal add and edit --}}
     <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="modal-judul"></h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
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
                                        <input type="text" class="form-control" id="categori" name="categori" value="">
                                        <span id="categoriError" class="text-danger"></span>
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


       {{-- modal delete --}}
       <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">PERHATIAN</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Hapus Categori, apakah anda yakin?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-sm" name="tombol-hapus" id="tombol-hapus">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete --}}


    <script>

        $(function(){
            $('#table-categori').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{route('dataCategori')}}",
                columns : [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action' },
                ]
            });
        });

        //ketika tombol tambah di tekan
        $('#tombol-tambah').on('click',function(){
            $('#id').val("");
            $('#form-tambah-edit').trigger('reset');
            $('#modal-judul').html('Tambah Categori');
            $('#tambah-edit-modal').modal('show');
        });



        //ketika tombol edit ditekan
        $('body').on('click','.edit-categori',function(){
            const id = $(this).attr('id');

            $.get('editCategori/' + id ,function(data){
                $('#tambah-edit-modal').modal('show');
                $('#modal-judul').html('Edit Categori')
                $('#categori').val(data.name);
                $('#id').val(data.id);
                $('#categoriError').text('');
            });
        });


        //ketika tombol smipan di tekan



        $('#form-tambah-edit').on('submit',function(e){

            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                type : "POST",
                url : "{{route('addCategori')}}",
                data : formData,
                processData : false,
                contentType : false,

                success:function(){
                    $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        const table = $('#table-categori')
                        .dataTable();
                        table.fnDraw(false);
                        iziToast.success({
                        title: 'Data Berhasil Disimpan',
                        message: '{{ Session('
                        success ')}}',
                        position: 'bottomRight'
                        });
                },

                error:function(data){

                    if(data.status == 422){
                        if(data.responseJSON.errors.categori){
                            $('#categoriError').text('field tidak boleh kosong')
                        }else{
                            $('#categoriError').text('');
                        }
                    }
                    console.log(data)
                }

            })
        })


        //ketika tombol hapus ditekan

        $('body').on('click','.delete-categori',function(){

            $('#konfirmasi-modal').modal('show')
            const dataId = $(this).attr('id');

            $('#tombol-hapus').on('click',function(){

                    $.ajax({
                    method : 'get',
                    url : 'deleteCategori/' + dataId,

                    success:function(){
                        $('#konfirmasi-modal').modal('hide');
                         table =  $('#table-categori')
                        .dataTable();
                        table.fnDraw(false);
                        iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                    },

                    error:function(data){

                        console.log(data)
                    }
                });

            });

        });


    </script>
@endsection
