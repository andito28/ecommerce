@extends('template.user')

@section('title')
    Cart
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">
   <table class="table">
          <tr>
                <td><b></b> Nama : {{Auth::user()->name}}</td>
           </tr>
            <tr>
                <td> Alamat : {{Auth::user()->address}}</td>
            </tr>
            <tr>
                <td>Telepon : {{Auth::user()->phone}}</td>
            </tr>

            <tr>
                <th>Product</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            @php
            $total = 0;
            @endphp

            @foreach ($transactions_detail as $detail)
                <tr>
                <td>{{$detail->product->name}}</td>
                <td>{{$detail->product->price}}</td>
                <td>{{$detail->qty}}</td>
                <td>{{$subtotal = ($detail->product->price * $detail->qty)}}</td>
                </tr>

                @php
                    $total += ($detail->product->price * $detail->qty);
                @endphp
                @endforeach
                <tr>
                    <td><h3><b>Total : Rp.{{number_format($total)}}</b></h3></td>
                    <td></td>
                    <td></td>
                </tr>
    </table>
</div>

</div>
    @endsection

