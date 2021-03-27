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
        <thead>
          <tr>
            <th scope="col">NO</th>
            <th scope="col">TGL Pesanan</th>
            <th scope="col">NO faktur</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{date('d  M  Y',strtotime($transaction->created_at))}}</td>
                <td>{{$transaction->id}}</td>
            <td><a href="{{route('detail',$transaction->id)}}">detail</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
    @endsection

