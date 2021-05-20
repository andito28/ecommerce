@extends('template.admin')

@section('title')
    Dashboard | Banner
@endsection

@section('content')
    <div class="col col-md-12">
        <div class="card card-shadow">
            <div class="card-header bg-white pb-10 pt-20">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tombol-tambah"> Add Banner</a>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                <table class="table table-bordered dt-responsive" id="table-banner">
                    <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Url</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>

         {{-- modal add and edit --}}
         <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
            <div class="modal-dialog">
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
                                        <label for="title" class="col-sm-12 control-label">Banner</label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" id="banner" name="banner">
                                            <span id="bannerError" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-sm-12 control-label">Url</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="url" name="url" value="">
                                            <span id="urlError" class="text-danger"></span>
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
                        <p>Hapus Banner, apakah anda yakin?</p>
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
            $('#table-banner').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "searching": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                ajax: "{{route('dataBanner')}}",
                columns : [
                    {data : 'image', name : 'image'},
                    { data: 'url', name: 'url' },
                    { data: 'action', name: 'action' },
                ]
            });
        });

        $('#tombol-tambah').on('click',function(){
            $('#id').val("");
            $('#form-tambah-edit').trigger('reset');
            $('#modal-judul').html('Tambah Banner');
            $('#tambah-edit-modal').modal('show');
        });


        $('#form-tambah-edit').on('submit',function(e){

            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type : 'POST',
                url : "{{route('storeBanner')}}",
                data : formData,
                processData : false,
                contentType : false,

                success:function(){
                    $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        const table = $('#table-banner')
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
                    console.log(data)
                }
            });
        });

        $('body').on('click','.editbanner',function(){

            const dataId = $(this).attr('id');

            $.get('editBanner/' + dataId ,function(data){
                $('#tambah-edit-modal').modal('show');
                $('#modal-judul').html('Edit Banner');
                $('#id').val(data.id);
                $('#url').val(data.url);

            });

        });

        $('body').on('click','.deletebanner',function(){
            const id = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');

            $('#tombol-hapus').on('click',function(){
                $.ajax({
                    method : 'get',
                    url : 'deleteBanner/'+id,

                    success:function(){
                        $('#konfirmasi-modal').modal('hide');
                         table =  $('#table-banner')
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
                })
            })
        })
    </script>
@endsection
