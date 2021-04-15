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
@php
    $categori = App\Categori::all()
@endphp
    <div class="col col-md-12">
        <div class="card card-shadow">
            <div class="card-header">HALAMAN PRODUCT</div>

            <div class="card-header bg-white pb-10 pt-30">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tombol-tambah"> Add Product</a>
            </div>

            <div class="card-body">

                <table class="table table-bordered dt-responsive" id="table-product">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

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
                                                <label for="title" class="col-sm-12 control-label">Name Product</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="title" name="nameProduct" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                <label for="title" class="col-sm-12 control-label pl-0">Price</label>
                                                  <input type="number" class="form-control" name="price" placeholder="Price">
                                                </div>
                                                <div class="col-sm-6">
                                                <label for="title" class="col-sm-12 control-label pl-0">Stock</label>
                                                  <input type="number" class="form-control" name="stock" placeholder="Stock">
                                                </div>
                                              </div>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="categori" class="col-sm-12 control-label">Categori</label>
                                                <div class="col-sm-12 input-group-append">
                                                <select class="form-control" id="exampleFormControlSelect1" name="categori_id">
                                                @foreach($categori as $ctg)
                                                    <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                                @endforeach
                                                </select>
                                                </div>
                                              </div>

                                           <div class="form-group">
                                                <label for="gambar" class="col-sm-12 control-label">Image</label>
                                                <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                                    <div class="col-sm-3 input-group-append">
                                                        {{-- <input type="text" id="gambar" class="form-control" readonly placeholder="input image">
                                                        <span class="btn btn-success btn-file">
                                                            Choose Image
                                                            <input type="file" name="image" id="image">
                                                        </span> --}}
                                                    <input type="file" name="image">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title" class="col-sm-12 control-label">Desc</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                </div>
                {{-- end modal delete --}}

                    </div>
                </div>
        </div>
    </div>

<script>
      $(function() {
                $('#table-product').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{route("dataProduct")}}',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'price', name: 'price' },
                        { data: 'stock', name: 'stock'},
                        { data: 'gambar', name: 'gambar'},
                        { data: 'action', name: 'action'}

                    ]
                });
            });

            //ketika tombol add product di tekan
             $('#tombol-tambah').click(function () {
                    $('#button-simpan').val("create-post"); //valuenya menjadi create-post
                    $('#id').val(''); //valuenya menjadi kosong
                    $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
                    $('#modal-judul').html("Tambah Product"); //valuenya tambah role baru
                    $('#tambah-edit-modal').modal('show'); //modal tampil
                });




            //ketika tombol simpan di tekan
            $(document).ready(function(e){

                $('#form-tambah-edit').on('submit',function(e){

                    e.preventDefault();

                   let formData = new FormData(this);

                $.ajax({
                    type : "POST",
                    url : "{{route('addProduct')}}",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success : function(data){
                        $('#form-tambah-edit').trigger("reset");
                        $('#tambah-edit-modal').modal('hide');
                        $('#tombol-simpan').html('Simpan');
                        var oTable = $('#table-product')
                        .dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        }

                });


                });
            });

            //ketika tombol edit di tekan
            $('body').on('click','.edit-product',function(){
                let id = $(this).data('id');
                $('#tambah-edit-modal').modal('show');
            })


            //ketika tombol delete di tekan
            $('body').on('click','.delete-product',function(){
                let id = $(this).attr('id');
                $('#konfirmasi-modal').modal('show');
            })
</script>
@endsection
