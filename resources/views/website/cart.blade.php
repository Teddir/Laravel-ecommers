<!doctype html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Home | Bookshop Responsive Bootstrap4 Template</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<!-- Favicons -->
		<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
		<link rel="apple-touch-icon" href="{{asset('images/icon.png')}}">
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
		<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
	
		<!-- Stylesheets -->
		<link rel="stylesheet" href="{{asset('css1/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css1/plugins.css')}}">
		<link rel="stylesheet" href="{{asset('css1/style.css')}}">
	
		<!-- Cusom css -->
		 <link rel="stylesheet" href="{{asset('css1/custom.css')}}">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
		<!-- Modernizer js -->
		<script src="{{asset('js1/vendor/modernizr-3.5.0.min.js')}}"></script>
	</head>
	<body>
	
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Shopping Cart</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="/store">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Shopping Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                        <form action="#">               
                            <div class="table-content wnro__table table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-update">Update</th>
                                            <th class="product-remove">Remove</th>
																					</tr>
                                    </thead>
																		{{-- {{dd($keranjang)}}; --}}
																		@foreach ($keranjang as $item)

																		{{$subtotal1 = $item->produk_price * $item->qty}}
																		{{-- {{dd($keranjang)}}; --}}
                                    <tbody>
                                        <tr>
																				<td class="product-thumbnail"><a href="#"><img src="{{$item->produk_image}}" alt="product img"></a></td>
                                            <td class="product-name"><a href="#">{{$item->produk_name}}</a></td>
																						<td class="product-price"><span class="amount">{{($item->produk_price)}}</span></td>
																							<form action="{{url('/admin/update3', $item->id)}}" method="post">@method('put') @csrf
																								<td class="product-quantity"><input type="number" name="qty" value="{{$item->qty}}"></td>
																								
																								<td class="product-subtotal">Rp. {{number_format($subtotal1)}}</td>
																								<td><button type="submit">Update Cart</button></td>
																							</form> 
																							<td class="product-remove">										
																								<form action="{{ url('/website/hapus', $item->id) }}" method="post">@method('delete') @csrf
																									<button type="submit">X</button></td>
																								</form>
																							</tr>
																						</tbody>
																						@endforeach
																					</table>
																					<form action="{{url('/website/cart/update', $item->id)}}" method="post">@method('put') @csrf
																			<button class="submit"> Check Out </button>
																		</form>
                            </div>
                        </form> 
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li><a href="#">Coupon Code</a></li>
                                <li><a href="#">Apply Code</a></li>
                            </ul>
                        </div>
                    </div>
								</div>
                <div class="row">
									<div class="col-lg-6 offset-lg-6">
										<div class="cartbox__total__area">
										<div class="cart__total__amount">
												<span>Grand Total</span>
												<span>Rp. {{number_format($subtotal)}}</span>
											</div>
										</div>
									</div>
                </div>
            </div>  
        </div>
        <!-- cart-main-area end -->
		<!-- Footer Area -->
		<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
			<div class="footer-static-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="footer__widget footer__menu">
								<div class="ft__logo">
									<a href="index.html">
										<img src="images/logo/3.png" alt="logo">
									</a>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered duskam alteration variations of passages</p>
								</div>
								<div class="footer__content">
									<ul class="social__net social__net--2 d-flex justify-content-center">
										<li><a href="#"><i class="bi bi-facebook"></i></a></li>
										<li><a href="#"><i class="bi bi-google"></i></a></li>
										<li><a href="#"><i class="bi bi-twitter"></i></a></li>
										<li><a href="#"><i class="bi bi-linkedin"></i></a></li>
										<li><a href="#"><i class="bi bi-youtube"></i></a></li>
									</ul>
									<ul class="mainmenu d-flex justify-content-center">
										<li><a href="index.html">Trending</a></li>
										<li><a href="index.html">Best Seller</a></li>
										<li><a href="index.html">All Product</a></li>
										<li><a href="index.html">Wishlist</a></li>
										<li><a href="index.html">Blog</a></li>
										<li><a href="index.html">Contact</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright__wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="copyright">
								<div class="copy__right__inner text-left">
									<p>Copyright <i class="fa fa-copyright"></i> <a href="https://freethemescloud.com/">Free themes Cloud.</a> All Rights Reserved</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="payment text-right">
								<img src="images/icons/payment.png" alt="" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- //Footer Area -->

	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="{{asset('js1/vendor/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('js1/popper.min.js')}}"></script>
	<script src="{{asset('js1/bootstrap.min.js')}}"></script>
	<script src="{{asset('js1/plugins.js')}}"></script>
	<script src="{{asset('js1/active.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>