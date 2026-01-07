$(document).ready(function() {

    $('#product_name').change(function() {
        var product_id = $(this).val();
        $.ajax({
            url: 'GetProductInfo/' + product_id,
            type: 'get',
            // token: $('meta[name="csrf-token"]').attr('content'),
            data: {
                id: product_id
            },
            success: function(response) {
                $('#price').val(response.price);
            }
        });
    });

});
