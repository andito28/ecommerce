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
                            <th>No</th>
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
                                                    <input type="text" class="form-control" id="nameProduct" name="nameProduct" value="">
                                                    <span id="nameError" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                <label for="title" class="col-sm-12 control-label pl-0">Price</label>
                                                  <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                                                  <span id="priceError" class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                <label for="title" class="col-sm-12 control-label pl-0">Stock</label>
                                                  <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock">
                                                  <span id="stockError" class="text-danger"></span>
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
                                                <span id="categoriError" class="text-danger"></span>
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
                                                <div class="col-sm-12 input-group-append">
                                                <span id="imageError" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title" class="col-sm-12 control-label">Desc</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                                                    <span id="descError" class="text-danger"></span>
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
                        {data: 'DT_RowIndex',name: 'DT_RowInde'},
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
                    $('#tombol-simpan').html('Add');
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
                        var oTable = $('#table-product')
                        .dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function (data ) {
                        console.log('Error:', data);

                        const message = "Field tidak boleh kosong";

                        if(data.status == 422){
                            if(data.responseJSON.errors.nameProduct){
                               $('#nameError').text(message);
                            }else{
                                $('#nameError').text('');
                            }

                            if(data.responseJSON.errors.price){
                               $('#priceError').text(message);
                            }else{
                                $('#priceError').text('');
                            }

                            if(data.responseJSON.errors.image){
                               $('#imageError').text('file harus berformat jpg/jpeg/png');
                            console.log('ok')
                            }else{
                                // $('#imageError').text('');
                            console.log('no')
                            }

                            if(data.responseJSON.errors.stock){
                               $('#stockError').text(message);
                            }else{
                                $('#stockError').text('');
                            }

                            if(data.responseJSON.errors.desc){
                               $('#descError').text(message);
                            }else{
                                $('#descError').text('');
                            }
                        }

                        }

                });


                });
            });

            //ketika tombol edit di tekan
            $('body').on('click','.edit-product',function(){
                let data_id = $(this).data('id');

                $.get('editProduct/' + data_id, function(data){
                    $('#tambah-edit-modal').modal('show');
                    $('#tombol-simpan').html('Update');
                    $('#id').val(data.id);
                    $('#nameProduct').val(data.name);
                    $('#stock').val(data.stock);
                    $('#price').val(data.price);
                    $('#desc').val(data.desc);
                    $('#nameError').text('');
                    $('#priceError').text('');
                    $('#stockError').text('');
                    $('#imageError').text('');
                    $('#descError').text('');
                    $('#nameError').text('');

                })

            })


            //ketika tombol delete di tekan dan memunculkan modal
            $('body').on('click','.delete-product',function(){
                let dataId = $(this).attr('id');
                $('#konfirmasi-modal').modal('show');


            //ketika tombol delete di tekan setelah ditampilkannya modal
            $('#tombol-hapus').click(function(){
                $.ajax({

                    method: "get",
                    url : "deleteProduct/" + dataId,

                    success:function(data){
                    $('#konfirmasi-modal').modal('hide');
                      table =  $('#table-product')
                        .dataTable();
                        table.fnDraw(false);
                    },
                    error:function(data){
                        console.log(data)
                    }
                });

        });

    });
</script>
@endsection
