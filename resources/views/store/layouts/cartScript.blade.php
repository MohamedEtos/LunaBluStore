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
