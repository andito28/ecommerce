@extends('template.user')

@section('title')
    Order
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="card p-4">
            <form action="{{route('orderStore')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlInput1"><h6>Nama Penerima</h6></label>
                  <input type="text" name="recipient_name" class="form-control" id="exampleFormControlInput1" placeholder="nama penerima">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1"><h6>Nomor telepon / WA</h6> </label>
                  <input type="number" name="number_tlp" class="form-control" id="exampleFormControlInput1" placeholder="nomor telepon">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1"><h6>Alamat Pengiriman</h6> </label>
                  <textarea name="recipient_address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
              </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
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
@endsection


