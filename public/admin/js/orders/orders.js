$(document).on('click', '.trRow', function () {
    const row = $(this);
    $('#order_number').text(row.find('.order_number').text());
    $('#product_name').text(row.find('.product_name').text());
    $('#subtotal').text(row.find('.subtotal').text());
    $('#shipping_cost').text(row.find('.shipping_cost').text());
    $('#total').text(row.find('.total').text());
    $('#governorate').text(row.find('.governorate').text());
    $('#created_at').text(row.find('.created_at').text());
    $('#full_name').text(row.find('.full_name').val() || row.find('.full_name').text());
    $('#phone').text(row.find('.phone').val() || row.find('.phone').text());
    $('#area').text(row.find('.area').val() || row.find('.area').text());
    $('#floor_number').text(row.find('.floor_number').val() || row.find('.floor_number').text());
    $('#building').text(row.find('.building').val() || row.find('.building').text());
    $('#address').text(row.find('.address').val() || row.find('.address').text());
});
