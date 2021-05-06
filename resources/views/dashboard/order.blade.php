@extends('template.admin')

@section('title')
    Dashboard | ORDERS
@endsection


@section('content')
<div class="col col-md-12">
    <div class="card card-shadow">
        <div class="card-header">HALAMAN ORDERS</div>

        {{-- <div class="card-header bg-white pb-10 pt-30">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tombol-tambah"> Add Product</a>
        </div> --}}

        <div class="card-body">

            <div class="table-responsive">
            <table class="table table-bordered dt-responsive" id="table-order">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>



            {{-- modal update --}}
            @php
            $orderStatus[0] = "Menunggu pembayaran";
            $orderStatus[1] = "Pembayaran sedang di validasi";
            $orderStatus[2] = "Pembayaran Lunas";
            $orderStatus[3] = "Pembayaran di tolak";
            @endphp

            <div class="modal fade"  id="konfirmasi-modal-update"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white"><b>Update Status Pembayaran</b></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="update-status">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleInputEmail1">No Faktur</label>
                                  <input type="text" class="form-control" id="id" name="id" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        @foreach ($orderStatus as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            {{-- end modal update --}}

             {{-- modal detail --}}
             <div class="modal fade"  id="konfirmasi-modal-detail" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white"><b>Detail Pesanan</b></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                          <div class="modal-body">
                              <span id="nama"></span>
                              <span id="product"></span>
                          </div>
                </div>
            </div>
            {{-- end modal detail--}}
             {{-- modal delete --}}
            {{-- <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal-delete" data-backdrop="false">
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
        $('#table-order').DataTable({
            serverSide : true,
            processing : true,
            responsive : true,
            ajax : "{{route('dataOrder')}}",
            columns : [
                {data : 'DT_RowIndex' , name: 'DT_RowIndex'},
                {data : 'id', name : 'id'},
                {data : 'nama' , name : 'nama'},
                {data : 'status', name : 'status'},
                {data : 'action', name : 'action'}
            ]
        });
    })


    $('body').on('click','.update',function(){
        const id = $(this).attr('id');

        $.get('editStatusPembayaran/' + id, function(data){


                    $('#konfirmasi-modal-update').modal('show');
                    $('#id').val(data.id);
                    $("#status").val(data.status)
                })
    });


    $('#update-status').on('submit',function(e){

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url : "{{route('updateStatus')}}",
            data: formData,
            processData : false,
            contentType : false,

            success:function(){
                        $('#update-status').trigger("reset");
                        $('#konfirmasi-modal-update').modal('hide');
                        var oTable = $('#table-order')
                        .dataTable();
                        oTable.fnDraw(false);
                        iziToast.success({
                        title: 'Status berhasil di Update',
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


    $('body').on('click','.detail',function(){

        let dataId = $(this).attr('id');

        $.get('detailPesanan/'+dataId,function(data){

            console.log(data)

            // $('#konfirmasi-modal-detail').modal('show');
            // $('#nama').text(data.order.name);
            // $('#product').text(data.deatail_order.product_id);
        })

    })


</script>


@endsection


