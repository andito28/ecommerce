@extends('template.user')

@section('title')
    Pesanan
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header text-center">
            <h5>List Pesanan</h5>
           </div>

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
                        $orderStatus[2] = "Lunas";
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

                        <td><a class="btn btn-info btn-sm" href="{{route('detailOrder',$order->id)}}">Detail Pesanan</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>

    </div>
</div>
@endsection


