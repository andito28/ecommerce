@extends('template.user')

@section('title')
    Order
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">

    @foreach($detailOrder as $detail)

    <span>{{$detail->product->name}}</span>

    @endforeach

</div>
@endsection


