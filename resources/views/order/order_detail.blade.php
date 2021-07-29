@extends('template.cart')

@section('title')
    Order
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')

<div class="container">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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

    <h3 id="pesanan">Detail Pesanan</h3>
    <hr>
    <div class="card shadow bg-white rounded">
        <div class="card-body">
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

            @if ($order->status == 0)
            <div class="alert alert-success" role="alert">
                <p>Silahkan Lakukan Pembayaran Ke Bank ABC</p>
                <p class="mb-0">Nomor Account : 1234-567-9810-1112 (Andito)</p>
                <p>Setelah Melakukan pembayaran, Silahkan lakukan konfirmasi pembayaran <a href="#" data-toggle="modal" data-target="#exampleModal" class="alert-link" style="color:blue">Disini</a></p>
            </div>
            @elseif($order->status == 3)
            <div class="alert alert-success" role="alert">
                <p><b> Pembayaran di tolak !!!</b></p>
                <p>Silahkan Lakukan Pembayaran Ke Bank ABC</p>
                <p class="mb-0">Nomor Account : 1234-567-9810-1112 (Andito)</p>
                <p>Setelah Melakukan pembayaran, Silahkan lakukan konfirmasi pembayaran <a href="#" data-toggle="modal" data-target="#exampleModal" class="alert-link" style="color:blue">Disini</a></p>
            </div>
            @elseif($order->status == 2)
            <div class="alert alert-success" role="alert">
                <p><b> Barang Sedang Dalam Pengiriman !!!</b></p>
            </div>
            @elseif($order->status == 1)
            <div class="alert alert-success" role="alert">
                <p><b> Pembayaran Sedang Di validasi !!!</b></p>
            </div>
            @endif

        </div>
      </div>
</div>

<div class="wa">
    <a href=" https://wa.me/6285298973249">
        <img src="{{asset('images/wp.png')}}" alt="" style="width:80px;height:80px;">
    </a>
</div>

<footer class="footer-distributed" style="margin-top:20px;">
    <div class="footer-right">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-gitlab"></i></a>
    </div>
    <div class="footer-left">
        <p class="footer-links">
            <a class="link-1" href="#">HOME</a>
            <a href="#">SHOP</a>
            <a href="#">ABOUT</a>
            <a href="#">FAQ</a>
        </p>
        <p> &copy; 2021</p>
    </div>

@endsection


