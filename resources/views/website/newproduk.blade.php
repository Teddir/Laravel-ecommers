@extends('website.store')

@section('newproduk')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="section__title text-center">
        <h2 class="title__be--2">New <span class="color--theme">Products</span></h2>
        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
      </div>
    </div>
  </div>
  <!-- Start Single Tab Content -->
  <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
    <!-- Start Single Product -->
    @foreach ($produk as $item)
    <div class="product product__style--3">
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="product__thumb">
          <a class="first__img" href="single-product.html"><img src="{{$item->image}}" alt="product image"></a>
          <a class="second__img animation1" href="single-product.html"><img src="uploads/produk/{{$item->image}}" alt="product image"></a>
          <div class="hot__box">
            <span class="hot-label">BEST SALLER</span>
          </div>
        </div>
        <div class="product__content content--center">
          <h4><a href="single-product.html">{{$item->name_produk}}</a></h4>
          <ul class="prize d-flex">
            <li>{{$item->harga}}</li>
            <li class="old_prize">{{$item->diskon}}</li>
          </ul>
          <div class="action">
            <div class="actions_inner">
              <ul class="add_to_links">
                <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
              <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" data-target="#productmodal{{$item->id}}" href=""><i class="fa fa-heart" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="product__hover--content">
            <ul class="rating d-flex">
              <li class="on"><i class="fa fa-star-o"></i></li>
              <li class="on"><i class="fa fa-star-o"></i></li>
              <li class="on"><i class="fa fa-star-o"></i></li>
              <li><i class="fa fa-star-o"></i></li>
              <li><i class="fa fa-star-o"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Start Single Product -->
    <!-- End Single Tab Content -->
    @endforeach
  </div>
      
{{-- @section('modal') --}}
@foreach ($produk as $item)
    
<div class="modal fade" id="productmodal{{$item->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal__container" role="document">
      <div class="modal-content">
          <div class="modal-header modal__header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <div class="modal-product">
                  <!-- Start product images -->
                  <div class="product-images">
                    <div class="main-image images">
                      <img alt="big images" src="{{$item->image}}">
                    </div>
                  </div>
                  <!-- end product images -->
                  <div class="product-info">
                      <h1>Simple Book</h1>
                      <div class="price-box-3">
                          <div class="s-price-box">
                              <span class="new-price">{{$item->harga}}</span>
                              <span class="old-price">{{$item->diskon}}</span>
                          </div>
                      </div>
                      <div class="quick-desc">
                          {{$item->desc}}
                      </div>																		
                      <div class="social-sharing">
                          <div class="widget widget_socialsharing_widget">
                              <h3 class="widget-title-modal">Share this product</h3>
                              <ul class="social__net social__net--2 d-flex justify-content-start">
                                  <li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                  <li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                  <li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                  <li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="addtocart-btn">
                        <form action="{{ url('/website/create', $item->id) }}" method="post">@method('get') @csrf
                          <button class="submit">Add to cart</button>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>
@endforeach

@endsection