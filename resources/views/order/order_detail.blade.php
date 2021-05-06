@extends('template.user')

@section('title')
    Order
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')

<div class="container">

    <div class="card">
        <div class="card-header text-center">
         <h5>Detail Pesanan</h5>
        </div>
        <div class="card-body">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('paymentConfirmationStore')}}" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Nomor Rekening</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="noRek" name="noRek" value="" placeholder="Nomor Rekening" required>
                                    <span id="noRekError" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Nama Account</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Nama Account">
                                    <span id="nameError" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Tanggal Pembayaran</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="tgl" name="tgl" value="">
                                    <span id="tglError" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Konfirmasi</button>
            </div>
        </form>
        </div>
        </div>
    </div>
          <table cellpadding="2">
                <tr>
                    <td>Nomor Faktur</td>
                    <td>:</td>
                    <td>{{$order->id}}</td>
                </tr>

                <tr>
                    <td>Nama Pemesan</td>
                    <td>:</td>
                    <td>{{Auth::user()->name}}</td>
                </tr>

                <tr>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td>{{$order->recipient_name}}</td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$order->recipient_address}}</td>
                </tr>

                <tr>
                    <td>Nomor telepon</td>
                    <td>:</td>
                    <td>{{$order->number_tlp}}</td>
                </tr>

                <tr>
                    <td>Tanggal Pemesanan</td>
                    <td>:</td>
                    <td>{{date('d  M  Y',strtotime($order->created_at))}}</td>
                </tr>
          </table>
          <br>

          <table class="table">
              <tr>
                  <th>No</th>
                  <th>Nama Product</th>
                  <th>Qty</th>
                  <th>Harga Satuan</th>
                  <th>Subtotal</th>
              </tr>

              @php
                  $total = 0;
                  $no = 1;
              @endphp

              @foreach($detailOrder as $detail)
              <tr>
                <td>{{$no}}</td>
                <td>{{$detail->product->name}}</td>
                <td>{{$detail->qty}}</td>
                <td>Rp {{number_format($detail->product->price)}}</td>
                <td>Rp {{number_format($detail->product->price * $detail->qty)}}</td>
              </tr>
                @php
                    $total += ($detail->product->price * $detail->qty);
                    $no++;
                @endphp
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total :</b></td>
                    <td><b> Rp.{{number_format($total)}}</b></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
          </table>

            @if ($order->status == 0 || $order->status == 3)
            <div class="alert alert-success" role="alert">
                <p>Silahkan Lakukan Pembayaran Ke Bank ABC</p>
                <p class="mb-0">Nomor Account : 1234-567-9810-1112 (Andito)</p>
                <p>Setelah Melakukan pembayaran, Silahkan lakukan konfirmasi pembayaran <a href="#" data-toggle="modal" data-target="#exampleModal" class="alert-link" style="color:blue">Disini</a></p>
            </div>
            @endif

        </div>
      </div>
</div>
@endsection


