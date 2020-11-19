@extends('website.store')

@section('bestseller')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="section__title text-center pb--50">
        <h2 class="title__be--2">Best <span class="color--theme">Seller </span></h2>
        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
      </div>
    </div>
  </div>
</div>
<div class="slider center" >
  @foreach ($produk as $item)
  <!-- Single product start -->
  
  <!-- Single product start -->
  <div class="product product__style--3" >
    <div class="product__thumb">
      <a class="first__img" href="single-product.html"><img src="{{$item->image}}" alt="product image"></a>
    </div>
    
    <div class="product__content content--center">
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
  @endforeach
  <!-- Single product end -->
</div>
@endsection