@extends('template.cart')

@section('title')
    Order
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">
    <h3 id="pesanan">Pesan</h3>
    <hr class="mt-3 mb-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 shadow bg-white rounded ">
            <form action="{{route('orderStore')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlInput1"><h6>Nama Penerima</h6></label>
                  <input type="text" name="recipient_name" class="form-control" id="exampleFormControlInput1" placeholder="nama penerima" required>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1"><h6>Nomor telepon / WA</h6> </label>
                  <input type="number" name="number_tlp" class="form-control" id="exampleFormControlInput1" placeholder="nomor telepon" required>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1"><h6>Alamat Pengiriman</h6> </label>
                  <textarea name="recipient_address" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Lengkap" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm button-p">Checkout</button>
              </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow bg-white rounded ">
                <table class="table">

                    <tbody>

                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>qty</th>
                                <th>subtotal</th>
                            </tr>
                        </thead>

                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $cart)
                      <tr>
                        <td>{{$cart->product->name}}</td>
                        <td>{{$cart->qty}}</td>
                        <td>Rp {{number_format($cart->product->price * $cart->qty)}}</td>
                      </tr>

                      @php
                          $subtotal = $cart->product->price * $cart->qty;
                          $total += $subtotal;
                      @endphp
                    @endforeach

                      <tr>
                          <td></td>
                          <td><b>Total</b></td>
                          <td><b>Rp {{number_format($total)}}</b></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
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


