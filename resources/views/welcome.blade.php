<!DOCTYPE html>
<html>

<head>
	<title>My E-Commerce</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap-4.1.3/dist/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>

<body>
    @guest
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark background">
		<a class="navbar-brand" href="/">My E-Commerce</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="nav-link underline" href="">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link underline" href="">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link underline" href="/shop">Our Product</a>
				</li>
				<li class="nav-item">
					<a class="nav-link button" href="/login">Sign In</a>
                </li>
			</ul>
		</div>
    </nav>
    @else
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark background">
            <a class="navbar-brand" href="#">My E-Commerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link underline" href="/cart"><i class="fa fa-shopping-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link underline" href="/orderList"><i class="fa fa-list"></i>Pesanan</a>
                    </li>
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/profile">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
        </li>
                </ul>
            </div>
        </nav>
        @endguest
	{{-- <div class="content-user">
		<h1 class="title">E - Commerce</h1>
		<h3 class="under-title">The Best Place for Any Solutions</h3>
	</div> --}}
	<div class="container">
		<div class="products">
			{{-- <h2 id="featured">Featured Products</h2> --}}
            <div class="slider">
                <div>
                    <a href="#">
                        <img src="{{asset('images/banner.png')}}" alt="Image 1" id="featured" style="width:100%;height:300px;">
                    </a>
                </div>
            </div>
            {{-- <img src="{{asset('images/banner.png')}}" alt="" id="featured" style="width:100%;height:300px;"> --}}
            <hr>
			<div class="row list-product">

                   @foreach($products as $product)
                   <div class="col-lg-4 col-md-6 pb-2 pt-2 pl-3 pr-3">
                    <div class="card shadow bg-white rounded" style="padding-top:20px;">
                   <a href="">
					<img src="{{asset('storage/product/'.$product->images)}}" alt="nopic" height="150" width="150" style="padding-bottom:20px;">
					</a>
                    <p class="product-name"><a href="#">{{$product->name}}</a></p>
                    <p class="product-price">Rp {{number_format($product->price)}}</p>
                    </div>
                  </div>
                  @endforeach

			</div>
		</div>
		<a href="/shop" class="more">Lihat Produk lainnya></a>
	</div>

    <div class="wa">
        <a href=" https://wa.me/6285298973249">
            <img src="{{asset('images/wp.png')}}" alt="" style="width:80px;height:80px;">
        </a>
    </div>

	<footer class="footer-distributed">
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

    </footer>
      <!-- JQuery -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <!-- Slick JS -->
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

      <!-- Our Script -->
      <script>
          $(document).ready(function(){
              $('.slider').slick({
                  autoplay: true,
                  autoplaySpeed: 2500,
                  dots: true
              });
          });
      </script>
	<script type="text/javascript" src="{{asset('bootstrap-4.1.3/dist/js/bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</body>

</html>
