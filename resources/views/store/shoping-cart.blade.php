@extends('store.layouts.master') {{-- أو layout بتاعك --}}

@section('content')

<form class="bg0 p-t-100 mt-5 p-b-85" id="cartPage">
	<div class="container">
		<div class="row">

			{{-- LEFT: table --}}
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">المنتج</th>
								<th class="column-2"></th>
								<th class="column-3">السعر</th>
								<th class="column-4">الكمية</th>
								<th class="column-5">المجموع</th>
							</tr>

                            <tbody id="cartTableBody">
							@if(!empty($cartData['items']) && count($cartData['items']) > 0)

								@foreach($cartData['items'] as $it)
									<tr class="table_row" data-product-id="{{ $it['product_id'] }}">

										<td class="column-1">
											<a class="how-itemcart1 mt-2 hov3 trans-04" href="{{ route('product.show', $it['slug']) }}"
                                                 data-product-id="{{ $it['product_id'] }}">
												    <img src="{{ $it['image'] ?: asset('store/images/placeholder.jpg') }}" alt="{{ $it['name'] }}">
                                            </a>
										</td>

										<td class="column-2">{{ $it['name'] }}</td>

										<td class="column-3">ج.م {{ number_format($it['price'], 2) }}</td>

										<td class="column-4">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m js-qty-minus">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>

												<input
                                                    class="mtext-104 cl3 txt-center num-product cart_qty"
                                                    type="number"
                                                    min="1"
                                                    value="{{ (int)$it['qty'] }}"
                                                    data-product-id="{{ $it['product_id'] }}"
                                                >

												<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m js-qty-plus">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>

                                            @if(isset($it['stock_available']))
                                                <small class="stext-111 cl6 d-block p-t-5">
                                                    المتاح: {{ (int)$it['stock_available'] }}
                                                </small>
                                            @endif
										</td>


										<td class="column-5 row_total">
                                            ج.م {{ number_format($it['line_total'], 2) }}
                                        </td>
									</tr>
								@endforeach

							@else
								<tr>
									<td colspan="5" class="p-4 text-center">
										السلة فاضية
									</td>
								</tr>
							@endif
                            </tbody>

						</table>
					</div>

					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5"
                                   type="text" name="coupon" placeholder="Coupon Code">

							<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
								Apply coupon
							</div>
						</div>

						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                             id="btnUpdateCart">
							تفريغ السله
						</div>
					</div>
				</div>
			</div>

			{{-- RIGHT: totals --}}
			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50" style="direction: rtl">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30" >
						مجموع السلة
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2">المجموع:</span>
						</div>

						<div class="size-209">
							<span class="mtext-110 cl2" id="pageSubtotal">
                                ج.م {{ number_format($cartData['subtotal'] ?? 0, 2) }}
							</span>
						</div>
					</div>

					{{-- Shipping block (زي ما هو) --}}
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">معلومات الشحن:</span>
						</div>

						<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
							<p class="stext-111 cl6 p-t-2">
                                يتم التوصيل عاده خلال 5-7 أيام عمل. يرجى إدخال عنوانك لتقدير وقت الشحن.
							</p>


							<div class="p-t-15">
								<span class="stext-112 cl8">رقم الهاتف</span>

								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    placeholder="مثال: 01012345678 أو +201012345678"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    maxlength="11"
                                    pattern="^(?:\+20|0020|0)?1[0125]\d{8}$"
                                    required
                                    />

                                    <div class="invalid-feedback">
                                    رقم الهاتف غير صحيح. أدخل رقم مصري مثل 01012345678 أو +201012345678
                                    </div>
                                </div>
								<span class="stext-112 cl8">رقم الهاتف</span>

								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    placeholder="مثال: 01012345678 أو +201012345678"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    maxlength="11"
                                    pattern="^(?:\+20|0020|0)?1[0125]\d{8}$"
                                    required
                                    />

                                    <div class="invalid-feedback">
                                    رقم الهاتف غير صحيح. أدخل رقم مصري مثل 01012345678 أو +201012345678
                                    </div>
                                </div>

							</div>
						</div>
					</div>

					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">Total:</span>
						</div>

						<div class="size-209 p-t-1">
							<span class="mtext-110 cl2" id="pageTotal">
                                ج.م {{ number_format($cartData['subtotal'] ?? 0, 2) }}
							</span>
						</div>
					</div>

					<button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
						Proceed to Checkout
					</button>

                    <a href="#" id="clearCart" class="d-block text-center p-t-20 stext-101 cl2 hov-cl1">
                        تفريغ السلة
                    </a>

				</div>
			</div>

		</div>
	</div>
</form>

@endsection

@section('script')


<script>
    (function ($) {
    "use strict";
        var headerDesktop = $('.container-menu-desktop');
        $(headerDesktop).addClass('fix-menu-desktop');

    })(jQuery);
</script>
<script>
/**
 * ✅ تكملة على كودك الموجود — نفس الأحداث لكن هنضيف:
 * - plus/minus buttons في صفحة cart
 * - تحديث Subtotal/Total في الصفحة بعد update/remove/clear
 * - إعادة حساب row total في الواجهة (اختياري)
 */

// لما المستخدم يدوس + / -
$(document).on('click', '.js-qty-plus', function () {
  const row = $(this).closest('tr.table_row');
  const input = row.find('.cart_qty');
  let qty = parseInt(input.val() || 1);
  qty++;
  input.val(qty).trigger('change'); // change event بتاعك هيعمل PATCH
});

// لما المستخدم يدوس - / -
$(document).on('click', '.js-qty-minus', function () {
  const row = $(this).closest('tr.table_row');
  const input = row.find('.cart_qty');
  let qty = parseInt(input.val() || 1);

  if (qty <= 1) {
    // حذف المنتج بدلاً من تخفيض الكمية تحت 1
    const productId = row.data('product-id') || input.data('product-id');
    $.ajax({
      url: "{{ route('cart.remove') }}",
      type: "DELETE",
      data: { product_id: productId },
      success: function (res) {
        $(".cartCount").attr("data-notify", res.cart.count);
        row.remove();
        updatePageTotals(res.cart);
        refreshSideCart();
      }
    });
    return;
  }

  qty = Math.max(1, qty - 1);
  input.val(qty).trigger('change');
});

// ✅ بعد أي update/remove/clear نحدّث totals في الصفحة + نعمل refreshSideCart
function updatePageTotals(cart){
  if(!cart) return;
  $('#pageSubtotal').text(`ج.م ${formatMoney(cart.subtotal)}`);
  $('#pageTotal').text(`ج.م ${formatMoney(cart.subtotal)}`);

  // تحديث row totals لو الريسبونس فيه items
  if(cart.items && cart.items.length){
    cart.items.forEach(it => {
      const row = $(`tr.table_row[data-product-id="${it.product_id}"]`);
      row.find('.row_total').text(`ج.م ${formatMoney(it.line_total)}`);
      row.find('.cart_qty').val(it.qty);
    });
  } else {
    // لو السلة فضيت
    $('#cartTableBody').html(`<tr><td colspan="5" class="p-4 text-center">السلة فاضية</td></tr>`);
  }
}

// ✅ Override على success بتاعتك: نخليها تحدث الصفحة كمان
$(document).on('change', '.cart_qty', function () {
  const productId = $(this).data('product-id');
  const qty = $(this).val();

  $.ajax({
    url: "{{ route('cart.update') }}",
    type: "PATCH",
    data: { product_id: productId, qty: qty },
    success: function (res) {
      $(".cartCount").attr("data-notify", res.cart.count);
      updatePageTotals(res.cart);
      refreshSideCart();
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
      $(".cartCount").attr("data-notify", res.cart.count);

      // احذف الصف من الجدول
      $(`tr.table_row[data-product-id="${productId}"]`).remove();

      updatePageTotals(res.cart);
      refreshSideCart();
    }
  });
});

$(document).on('click', '#clearCart', function (e) {
  e.preventDefault();

  $.ajax({
    url: "{{ route('cart.clear') }}",
    type: "DELETE",
    success: function (res) {
      $(".cartCount").attr("data-notify", '0');
      updatePageTotals({subtotal:0, count:0, items:[]});
      refreshSideCart();
    }
  });
});

// زر Update Cart: يحدث كل المنتجات مرة واحدة
$(document).on('click', '#btnUpdateCart', function () {
  const inputs = $('.cart_qty');
  if(!inputs.length) return;

  // هننفذ PATCH لكل منتج (زي نظامك الحالي)
  inputs.each(function(){
    $(this).trigger('change');
  });
});

</script>
@endsection
