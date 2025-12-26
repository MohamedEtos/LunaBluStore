

<script>

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
            refreshSideCart();

        $(".cartCount").attr("data-notify", res.cart.count); // Change the href

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
    $(".cartCount").attr("data-notify", res.cart.count); // Change the href

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
    $(".cartCount").attr("data-notify", res.cart.count); // Change the href

    }
  });
});



$(document).on('click', '#clearCart', function () {
  $.ajax({
    url: "{{ route('cart.clear') }}",
    type: "DELETE",
    success: function (res) {
          $(".cartCount").attr("data-notify", '0'); // Change the href

    }
  });
});


$(document).ready(function () {
  $.get("{{ route('cart.show') }}", function (res) {
    $('.cartCount').attr('data-notify', res.count);

  });
});






$(document).ready(function () {
  refreshSideCart();
});

// ✅ تجيب السلة وترسمها
function refreshSideCart() {
  $.get("{{ route('cart.show') }}", function (res) {

    // res = { items:[], subtotal:..., count:... }  (زي اللي طالع عندك)

    // 1) رسم العناصر
    const ul = $('#sideCartItems');
    ul.empty();

    if (!res.items || res.items.length === 0) {
      ul.append(`<li class="p-t-20 p-b-20 text-center">السلة فاضية</li>`);
      $('#sideCartTotal').text('اجمالي: ج.م0.00');
      // عداد الأيقونة لو عندك
      $('.cartCount').attr('data-notify', 0);
      return;
    }

    res.items.forEach(item => {
      ul.append(`
        <li class="header-cart-item flex-w flex-t m-b-12">
          <div class="header-cart-item-img">
            <img src="${item.image}" alt="IMG">
          </div>

          <div class="header-cart-item-txt p-t-8">

            <div class="d-flex align-items-center">
              <a href="/product/${item.product_id}" class="header-cart-item-name hov-cl1 trans-04 mr-3">
                ${escapeHtml(item.name)}
              </a>

              <button type="button"
                class="btn btn-link p-0 cl2 fs-25 ml-2 hov-cl1 js-remove-sidecart"
                data-product-id="${item.product_id}">
                <i class="zmdi zmdi-close"></i>
              </button>
            </div>

            <span class="header-cart-item-info">
              ${item.qty} x ج.م${formatMoney(item.price)}
            </span>
          </div>
        </li>
      `);
    });

    // 2) تحديث الإجمالي
    $('#sideCartTotal').text(`اجمالي: ج.م${formatMoney(res.subtotal)}`);

    // 3) تحديث عداد أيقونة السلة (لو عندك)
    $('.cartCount').attr('data-notify', res.count);
  });
}

// ✅ حذف عنصر من السلة (زر X)
$(document).on('click', '.js-remove-sidecart', function () {
  const productId = $(this).data('product-id');

  $.ajax({
    url: "{{ route('cart.remove') }}",
    type: "DELETE",
    data: { product_id: productId },
    success: function () {
      refreshSideCart();
    }
  });
});

// ✅ تفريغ السلة
$(document).on('click', '#clearCart', function (e) {
  e.preventDefault();

  $.ajax({
    url: "{{ route('cart.clear') }}",
    type: "DELETE",
    success: function () {
      refreshSideCart();
    }
  });
});

// Helpers
function formatMoney(val) {
  return Number(val || 0).toFixed(2);
}
function escapeHtml(text) {
  return String(text ?? '')
    .replaceAll('&','&amp;')
    .replaceAll('<','&lt;')
    .replaceAll('>','&gt;')
    .replaceAll('"','&quot;')
    .replaceAll("'","&#039;");
}




</script>
