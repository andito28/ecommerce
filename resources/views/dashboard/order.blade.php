@extends('template.admin')

@section('title')
    Dashboard | ORDERS
@endsection


@section('content')
<div class="col col-md-12">
    <div class="card card-shadow">

        {{-- <div class="card-header bg-white pb-10 pt-30">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tombol-tambah"> Add Product</a>
        </div> --}}

        <div class="card-body">

            <div class="table-responsive">
            <table class="table table-bordered dt-responsive" id="table-order">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl pemesanan</th>
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

            {{-- <div class="modal fade"  id="konfirmasi-modal-update"  aria-hidden="true">
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
            </div> --}}
            {{-- end modal update --}}

             {{-- modal detail --}}
             <div class="modal fade"  id="konfirmasi-modal-detail" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white"><b>Detail Pesanan</b></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                          <div class="modal-body pb-0">

                            <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                <table cellpadding="5">
                                    <tr>
                                        <td>Nomor Faktur</td>
                                        <td>:</td>
                                        <td id="no"></td>
                                    </tr>

                                    <tr>
                                        <td>Nama Pemesan</td>
                                        <td>:</td>
                                        <td id ="namaPemesan"></td>
                                    </tr>

                                    <tr>
                                        <td>Nama Penerima</td>
                                        <td>:</td>
                                        <td id="namaPenerima"></td>
                                    </tr>

                                    <tr>
                                        <td>Alamat Pengiriman</td>
                                        <td>:</td>
                                        <td id="alamat"></td>
                                    </tr>

                                    <tr>
                                        <td>Nomor telepon</td>
                                        <td>:</td>
                                        <td id="nomor"></td>
                                    </tr>

                                    <tr>
                                        <td>Tanggal Pemesanan</td>
                                        <td>:</td>
                                        <td id="tgl"></td>
                                    </tr>
                            </table>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-danger">
                                <div class="card-header text-center bg-success">
                                    Konfirmasi Pembayaran
                                </div>
                                <div class="card-footer pt-0">

                                    <span id="confirm"></span>
                                    <table id="table-payment" cellpadding="2">
                                        <tr>
                                            <td>Nomor Rekening</td>
                                            <td>:</td>
                                            <td id="norek"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Account</td>
                                            <td>:</td>
                                            <td id="account"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pembayaran</td>
                                            <td>:</td>
                                            <td id="tglPembayaran"></td>
                                        </tr>
                                    </table>
                                </div>
                                <form id="update-status">
                                    @csrf
                                    <div class="form-group">
                                      <input type="hidden" class="form-control" id="id" name="id" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            @foreach ($orderStatus as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke pb-0">
                                        <button type="submit" id="updateS" class="btn btn-primary btn-sm">Update Status</button>
                                    </div>
                            </div>

                        </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <table class="table" id="table-detail">
                            <thead>
                              <tr>
                                  <th>Nama Product</th>
                                  <th>Qty</th>
                                  <th>Harga Satuan</th>
                                  <th>Subtotal</th>
                              </tr>
                            </thead>

                            <tbody></tbody>
                          </table>
                          <button class="btn btn-primary btn-sm mb-15 pr-30 pl-30">Cetak</button>
                    </div>

                            {{-- @if ($order->status == 0 || $order->status == 3)
                            <div class="alert alert-success" role="alert">
                                <p>Silahkan Lakukan Pembayaran Ke Bank ABC</p>
                                <p class="mb-0">Nomor Account : 1234-567-9810-1112 (Andito)</p>
                                <p>Setelah Melakukan pembayaran, Silahkan lakukan konfirmasi pembayaran <a href="#" data-toggle="modal" data-target="#exampleModal" class="alert-link" style="color:blue">Disini</a></p>
                            </div>
                            @endif --}}
                          </div>
                </div>
            </div>



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
                {data : 'tgl', name : 'tgl'},
                {data : 'nama' , name : 'nama'},
                {data : 'status', name : 'status'},
                {data : 'action', name : 'action'}
            ]
        });
    })


    // $('body').on('click','.update',function(){
    //     const id = $(this).attr('id');

    //     $.get('editStatusPembayaran/' + id, function(data){


    //                 $('#konfirmasi-modal-update').modal('show');
    //                 $('#id').val(data.id);
    //                 $("#status").val(data.status)
    //             })
    // });


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
                        $('#konfirmasi-modal-detail').modal('hide');
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

            $("#table-detail tbody").empty();
            $('#konfirmasi-modal-detail').modal('show');


            let total = 0;

            $.each(data.detail_order, function(index) {

                var product_name = data.detail_order[index].product.name;
                var qty = data.detail_order[index].qty;
                var price = data.detail_order[index].product.price;
                var subTotal = (qty * price );

                var tr_1 = "<tr>" +
                   "<td '>" + product_name + "</td>" +
                   "<td '>" + qty + "</td>" +
                   "<td '>" + price + "</td>" +
                   "<td '>" + subTotal + "</td>" +
                 "</tr>";
                 $("#table-detail tbody").append(tr_1);

                    total = total + subTotal;

        });

        var tr_2 = "<tr>" +
                   "<td>" + " "+ "</td>" +
                   "<td>" + " "+ "</td>" +
                   "<td>" +  "Total  :" + "</td>" +
                   "<td>" + total + "</td>" +
                 "</tr>";
                 $("#table-detail tbody").append(tr_2);

                $('#no').html(data.order.id);
                $('#namaPemesan').html(data.order.user.name);
                $('#namaPenerima').html(data.order.recipient_name);
                $('#alamat').html(data.order.recipient_address);
                $('#nomor').html(data.order.number_tlp);
                $('#tgl').html(data.order.created_at);

                $('#tgl').html(data.order.created_at);
                $('#tgl').html(data.order.created_at);


                if(data.payment == null){
                  $('#table-payment').hide();
                   let h3 = document.createElement('h3');
                   h3.className = "text-danger text-center";
                   h3.innerHTML = "Belum melakukan pembayaran";
                //    $('#updateS').hide();

                   $('#confirm').html(h3);


                }else{
                $('#table-payment').show();
                $('#norek').html(data.payment.no_rekening);
                $('#account').html(data.payment.nama_account);
                $('#tglPembayaran').html(data.payment.tanggal_pembayaran);
                $('#confirm').html("");

                }

                $('#id').val(data.order.id);
                $("#status").val(data.order.status)

                console.log(data)

        })

    })


</script>


@endsection


