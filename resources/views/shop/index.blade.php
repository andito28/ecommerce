@extends('template.user')

@section('title')
    Shop
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/shop.css')}}">
@endsection

@php
    $search = isset($_GET['search'])? $_GET['search'] : false;
@endphp

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 pt-100">
        <div class="category">
          <h3 id="category-label">Categories</h3>
          <ul class="list-group">
          <li class="list-group-item {{$id == null ?'active':''}}"><a href="{{route('shop')}}"> All</a></li>
            @foreach($categoris as $categori)
          <li class="list-group-item {{$categori->id == $id ?'active':''}}"><a href="{{route('categori',$categori->id)}}">{{$categori->name}}</a></li>
           @endforeach
          </ul>
        </div>
        <h2 id="category-label" class="text-center mt-5">Search Product</h2>
    <form action="{{route('shop')}}" class="form-inline ml-5">
    <input type="text" class="form-control" name="search" value="{{$search}}">
          <button class="btn btn-primary">Search</button>
        </form>
      </div>
        <div class="col-lg-8">
          <div class="item-list">
          <h4>Our Products</h4>
          <hr style="margin-bottom: 2em;">
          <div class="row list-product">
            @foreach($products as $product)
            <div class="col-lg-4 item mb-5 pt-10">
            <div class="card">
            <div class="item" style="padding-top:10px;padding-bottom:10px;">
            <a href="{{route('shopsow',$product->id)}}">
              <img src="{{asset('storage/product/'.$product->images)}}" alt="nopic" height="100px" width="100px">
              </a>
            <p class="product-name mt-3 font-weight-bold"><a href="{{route('shopsow',$product->id)}}">{{$product->name}}</a></p>
            <p class="product-price">Rp.{{number_format($product->price)}}</p>

            </div>
            </div>
            </div>
            @endforeach
          </div>
          {{$products->links()}}
        </div>
      </div>
    </div>
  </div>
  <!-- Pagination Link -->
  {{-- {{$items->links()}} --}}
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection

