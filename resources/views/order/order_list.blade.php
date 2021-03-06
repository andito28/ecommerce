@extends('template.cart')

@section('title')
    Pesanan
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">

    <h3 id="pesanan">List Pesanan</h3>
    <hr>
    <div class="card shadow bg-white rounded ">
        <div class="card-body">
            <div class="table-responsive-sm">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">TGL Pesanan</th>
                    <th scope="col">NO faktur</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $orderStatus[0] = "Menunggu pembayaran";
                        $orderStatus[1] = "Pembayaran sedang di validasi";
                        $orderStatus[2] = "Pembayaran Lunas";
                        $orderStatus[3] = "Pembayaran di tolak";
                    @endphp

                    @foreach ($orders as $order)

                    @php
                        $status = $order->status;
                    @endphp
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{date('d  M  Y',strtotime($order->created_at))}}</td>
                        <td>{{$order->id}}</td>
                        @if ($order->status == 0)
                        <td>
                                <span class="badge badge-pill badge-primary p-2">{{$orderStatus[$status]}}</span>
                        </td>
                        @elseif($order->status == 1)
                        <td>
                                <span class="badge badge-pill badge-warning p-2">{{$orderStatus[$status]}}</span>
                        </td>
                        @elseif($order->status == 2)
                        <td>
                                <span class="badge badge-pill badge-success p-2">{{$orderStatus[$status]}}</span>
                        </td>
                        @else
                        <td>
                                <span class="badge badge-pill badge-danger p-2">{{$orderStatus[$status]}}</span>
                        </td>
                        @endif

                        <td><a class="btn btn-primary btn-sm" href="{{route('detailOrder',$order->id)}}">Detail Pesanan</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
    {{$orders->links()}}
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


