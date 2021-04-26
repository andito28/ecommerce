@extends('template.cart')

@section('title')
    Cart
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">
    <!-- success message & Error message -->
        @php
            $total = 0;
        @endphp
    {{-- @if ($carts->count() == 0)
    <p style="text-align:center;">Your Cart is Empty</p>
    @else --}}

    @if ($message = session('warning'))
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @elseif($message = session('delete'))
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
    @endif
<div>
    <h3>{{$carts->count()}} Item in your cart</h3>
</div>
@foreach($carts as $cart)
<div class="cart pb-0">
        <div class="row">
            <div class="col-lg-3">
            <img class="img-cart" src="{{asset('storage/product/'.$cart->product->images)}}" alt="">
            </div>
            <div class="col-lg-9">
                <div class="top">
                <p class="item-name">{{$cart->product->name}}</p>
                    <div class="top-right">
                    <p class="">Rp.{{number_format($cart->product->price)}}</p>
                    <select name="qty" class="quantity" data-item="{{$cart->id}}">
                        @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}" {{$cart->qty == $i ? 'selected' : ''}}>{{$i}}</option>
                        @endfor
                        </select>
                        <!-- Subtotal -->
                        @php
                            $subtotal = ($cart->product->price * $cart->qty);
                        @endphp
                        <p class="total-item">Rp.{{number_format($subtotal)}}</p>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="bottom">
                   <div class="row">
                        <p class="col-md-6 item-desc">
                           Deskripsi
                        </p>
                        <div class="offset-md-4">

                        </div>
                        <div class="col-md-2">
                        <!-- delete cart -->
                        <form action="{{route('cartdelete',$cart->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @php
    $total += ($cart->product->price * $cart->qty);
    @endphp
    @endforeach
    {{-- @php
    $total += ($cart->item->price * $cart->quantity);
    @endphp --}}

    <div class="row">
    <div class="col-md-6">
        <!-- Button trigger modal -->
        @if(count($carts) > 0)
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-top:40px;">
            Checkout
        </button> --}}

        <a href="{{route('order')}}" class="btn btn-primary" style="margin-top:40px;">Checkout</a>
        @endif
    </div>

    <div class="col-md-6">
        <h4 class="total-price">Total Price: Rp.{{number_format($total)}}</h4>
    </div>
</div>


</div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table cellpadding="5px">
                <tr>
                    <th>Product</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                @php
                $total = 0;
                @endphp

                @foreach ($carts as $cart)
                    <tr>
                    <td>{{$cart->product->name}}</td>
                    <td>{{$cart->product->price}}</td>
                    <td>{{$cart->qty}}</td>
                    <td>{{$subtotal = ($cart->product->price * $cart->qty)}}</td>
                    </tr>

                    @php
                        $total += ($cart->product->price * $cart->qty);
                    @endphp
                    @endforeach


                    <tr>
                        <td><h5><b>Total : Rp.{{number_format($total)}}</b></h5></td>
                        <td></td>
                        <td></td>
                    </tr>
            </table>

            <form>
                <div class="form-group">
                  <label for="formGroupExampleInput">Example label</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Another label</label>
                  <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
{{-- <form action="{{route('checkout')}}" method="POST" style="margin-left: 700px;">
@csrf
@if(count($carts) < 1)
    <button type="submit" class="btn btn-primary" disabled>Checkout</button>
@else
    <button type="submit" class="btn btn-primary">Checkout</button>
@endif
</form> --}}
    {{-- @endif --}}
@endsection

@section('script')
<script type="text/javascript">
    (function(){
    const classname = document.querySelectorAll('.quantity');

    Array.from(classname).forEach(function(element){
     element.addEventListener('change', function(){
        const id = element.getAttribute('data-item');
        axios.patch(`/cart/${id}`, {
            quantity: this.value,
            id: id
          })
          .then(function (response) {
            //console.log(response);
            window.location.href = '/cart'
          })
          .catch(function (error) {
            console.log(error);
          });
   })
 })
    })();
</script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection
