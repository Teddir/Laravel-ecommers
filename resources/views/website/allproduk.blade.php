@extends('website.store')

@section('allproduk')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="section__title text-center">
        <h2 class="title__be--2">All <span class="color--theme">Products</span></h2>
        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
      </div>
    </div>
  </div>
  <div class="row mt--50">
    <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="product__nav nav justify-content-center" role="tablist">
                      <a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">ALL</a>
                      <a class="nav-item nav-link" data-toggle="tab" href="#nav-biographic" role="tab">BIOGRAPHIC</a>
                      <a class="nav-item nav-link" data-toggle="tab" href="#nav-adventure" role="tab">ADVENTURE</a>
                      <a class="nav-item nav-link" data-toggle="tab" href="#nav-children" role="tab">CHILDREN</a>
                      <a class="nav-item nav-link" data-toggle="tab" href="#nav-cook" role="tab">COOK</a>
                  </div>
    </div>
  </div>
  @foreach ($produk as $item)
  <div class="tab__container mt--60">
    <!-- Start Single Tab Content -->
    <div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
      <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
        <div class="single__product">
          <!-- Start Single Product -->
          
          <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="product product__style--3">
              <div class="product__thumb">
                <a class="first__img" href="single-product.html"><img src="{{$item->image}}" alt="product image"></a>
              <a class="second__img animation1" href="single-product.html"><img src="{{$item->image}}" alt="{{$item->image}}"></a>
                <div class="hot__box">
                  <span class="hot-label">BEST SALER</span>
                </div>
              </div>
              <div class="product__content content--center content--center">
                <h4><a href="single-product.html">{{ $item->name_produk}}</a></h4>
                <ul class="prize d-flex">
                  <li>$50.00</li>
                  <li class="old_prize">$35.00</li>
                </ul>
                <div class="action">
                  <div class="actions_inner">
                    <ul class="add_to_links">
                      <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                      <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                      <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
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
        </div>
      </div>
    </div>
    <!-- End Single Tab Content -->
  </div>
  @endforeach
</div>
@endsection