@extends('store.layouts.master')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')


	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60 m-t-100  " >
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="{{ asset($product->product_img_p->mainImage) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset($product->product_img_p->mainImage) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->product_img_p->mainImage) }}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="{{ asset($product->product_img_p->img2) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset($product->product_img_p->img2) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->product_img_p->img2) }}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="{{ asset($product->product_img_p->img3) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset($product->product_img_p->img3) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->product_img_p->img3) }}">
											<i class="fa fa-expand"></i>
										</a>
									</div>

								</div>
								<div class="item-slick3" data-thumb="{{ asset($product->product_img_p->img4) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset($product->product_img_p->img4) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->product_img_p->img4) }}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h1 class="mtext-105 h4 cl2 js-name-detail p-b-14">
							{{ $product->name }}
                        </h1>

						<span class="mtext-106 cl2">
							{{ $product->price }}
						</span>

						<p class="stext-102 cl3 p-t-23">
							{{ $product->productDetalis }}
						</p>

						<!--  -->
						<div class="p-t-33">
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6">
									المقاس
								</div>

								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="time">
											<option disabled>Choose an option</option>
											<option selected >180</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6">
									القماش
								</div>

								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="time">
											<option disabled>Choose an option</option>
											<option selected>{{ $product->fabricType->name }}</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>
                                            <input class="mtext-104 cl3 txt-center qty qty_product num-product "
                                             type="number" name="num-product" value="1"
                                             >

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button data-product-id="{{ $product->id }}"  class="  flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 add_cart js-addcart-detail">
										Add to cart
									</button>
								</div>
							</div>
						</div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">

							<a href="https://www.facebook.com/profile.php?id=61583415522354" data-tooltip="facebook" aria-label="Visit our Facebook page" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2  tooltip100">
                                <span class="sr-only">facebook</span>
                                <i class="fa fa-facebook"></i>
							</a>
							<a href="https://www.instagram.com/luna.blustore/" data-tooltip="instagram" aria-label="Visit our instagram page" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2  tooltip100">
                                <span class="sr-only">instagram</span>
                                <i class="fa fa-instagram"></i>
							</a>
							<a href="https://wa.me/01554063260" data-tooltip="whatsapp" aria-label="Visit our whatsapp " class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2  tooltip100">
                                <span class="sr-only">whatsapp</span>
                                <i class="fa fa-whatsapp"></i>
							</a>


						</div>
					</div>
				</div>
			</div>

			{{-- <div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01 " dir="rtl">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">الوصف</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">تفاصيل</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">التقيم (1)</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									{{ $product->productDetalis }}
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
                                                الوزن
											</span>

											<span class="stext-102 cl6 size-206">
												0.79 kg
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>

											<span class="stext-102 cl6 size-206">
												110 x 33 x 100 cm
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Materials
											</span>

											<span class="stext-102 cl6 size-206">
												60% cotton
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>

											<span class="stext-102 cl6 size-206">
												Black, Blue, Grey, Green, Red, White
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>

											<span class="stext-102 cl6 size-206">
												XL, L, M, S
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="store/images/avatar-01.avif" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>

													<span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
												</div>

												<p class="stext-102 cl6">
													Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
												</p>
											</div>
										</div>

										<!-- Add review -->
										<form class="w-full">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				الخامه :{{ $product->fabricType->name }}
			</span>

			<span class="stext-107 cl6 p-lr-25">
				 {{ $product->name  }}
			</span>
		</div>
	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					منتجات ذات صلة
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($products as $product  )
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <a href="{{ route('product.show', $product->slug) }}">

                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                                    <img
                                                    src="{{ asset(Str::before($product->product_img_p->mainImage, '-') . '-800.webp') }}"
                                                    srcset="
                                                        {{ asset(Str::before($product->product_img_p->mainImage, '-') . '-320.webp') }} 320w,
                                                        {{ asset(Str::before($product->product_img_p->mainImage, '-') . '-480.webp') }} 480w,
                                                        {{ asset(Str::before($product->product_img_p->mainImage, '-') . '-800.webp') }} 800w,
                                                        {{ asset(Str::before($product->product_img_p->mainImage, '-') . '-1200.webp') }} 1200w
                                                    "
                                                    sizes="(max-width: 600px) 45vw,
                                                        (max-width: 1200px) 25vw,
                                                        300px"
                                                    alt="{{ $product->product_img_p->alt1 }}"
                                                    loading="lazy"
                                                    decoding="async"
                                                >

                                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            نظره سريعة
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                        {{ $product->name }}
                                            </a>

                                            <span class="stext-105 cl3 unit_price" >
                                                {{ $product->price }}
                                            </span>
                                        </div>

                                        <div class="block2-txt-child2 flex-r p-t-3">
                                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                <img class="icon-heart1 dis-block trans-04" src="{{ asset('store/images/icons/icon-heart-01.png') }}" alt="ICON">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('store/images/icons/icon-heart-02.png') }}" alt="ICON">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
			</div>
		</div>
	</section>



@endsection

@section('script')
<script>
    (function ($) {
    "use strict";
        var headerDesktop = $('.container-menu-desktop');
        $(headerDesktop).addClass('fix-menu-desktop');
    })(jQuery);








$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('click', '.add_cart', function (e) {
  e.preventDefault();

  const productId = $(this).data('product-id');
  const qty = $('.qty').val();

  $.post("{{ route('cart.add') }}", { product_id: productId, qty: qty })
    .done(function (res) {
        $("#cartCount").attr("data-notify", res.cart.count); // Change the href

      console.log(res.cart);
    })
    .fail(function (xhr) {
      alert('Error: ' + xhr.status);
    });
});


$(document).on('change', '.cart_qty', function () {
  const productId = $(this).data('product-id');
  const qty = $(this).val();

  $.ajax({
    url: "{{ route('cart.update') }}",
    type: "PATCH",
    data: { product_id: productId, qty: qty },
    success: function (res) {
    $("#cartCount").attr("data-notify", res.cart.count); // Change the href

      console.log(res.cart);
    }
  });
});



$(document).on('click', '.remove_item', function () {
  const productId = $(this).data('product-id');

  $.ajax({
    url: "{{ route('cart.remove') }}",
    type: "DELETE",
    data: { product_id: productId },
    success: function (res) {
    $("#cartCount").attr("data-notify", res.cart.count); // Change the href

    }
  });
});



$(document).on('click', '#clearCart', function () {
  $.ajax({
    url: "{{ route('cart.clear') }}",
    type: "DELETE",
    success: function (res) {
          $("#cartCount").attr("data-notify", '0'); // Change the href

    }
  });
});


$(document).ready(function () {
  $.get("{{ route('cart.show') }}", function (res) {
    $('#cartCount').attr('data-notify', res.count);

  });
});







</script>




@endsection
