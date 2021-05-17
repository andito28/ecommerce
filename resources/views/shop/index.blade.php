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
      <div class="col-lg-4">
        <div class="category">
          <h4 id="category-label">Kategori pilihan</h4>
          <ul class="list-group">
          <li class="list-group-item {{$id == null ?'active':''}}"><a href="{{route('shop')}}"> All</a></li>
            @foreach($categoris as $categori)
          <li class="list-group-item {{$categori->id == $id ?'active':''}}"><a href="{{route('categoriId',$categori->id)}}">{{$categori->name}}</a></li>
           @endforeach
          </ul><br>
          {{-- {{$categoris->links()}} --}}
        </div>


      </div>
        <div class="col-lg-8">
          <div class="item-list">
            <div class="row">
              <div class="col-md-6">
                  <h4 class="mb-0">Produk kami</h4>
              </div>

              <div class="col-md-6">
                <form action="{{route('shop')}}" class="form-inline ml-4">
                    <input type="text" class="form-control" name="search" value="{{$search}}" placeholder="Pencarian . . . . .">
                    <button class="btn btn-primary ">C a r i</button>
                  </form>
              </div>
            </div>
          <hr style="margin-bottom: 2em;height:2px;border:none;">
          <div class="row list-product">
            @if($products->count() < 1)

            <div class="col-lg-12 item mb-5 pt-10">
                <div class="card">
                    <div class="card-body" style="padding-bottom:50px;padding-top:50px;">
                        <h3>Produk Belum ada </h3>
                    </div>
                </div>
            </div>

            @else
            @foreach($products as $product)
            <div class="col-lg-4 item mb-5 pt-10">
            <div class="card">
            <div class="item" style="padding-top:10px;padding-bottom:10px;">
            <a href="{{route('shopsow',$product->id)}}">
              <img src="{{asset('storage/product/'.$product->images)}}" alt="nopic" height="100px" width="100px">
              </a>
            <p class="product-name mt-3"><a href="{{route('shopsow',$product->id)}}">{{$product->name}}</a></p>
            <p class="product-price">Rp {{number_format($product->price)}}</p>

            </div>
            </div>
            </div>
            @endforeach

            @endif
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

