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





  let itemIndex = 1;

  function calcInvoiceTotal() {
    let sum = 0;

    $('.invoice-item').each(function () {
      const price = parseFloat($(this).find('.item-price').val()) || 0;
      const qty   = parseFloat($(this).find('.item-qty').val()) || 0;
      sum += (price * qty);
    });

    const discount = parseFloat($('#descount').val()) || 0;
    let total = sum - discount;

    if (total < 0) total = 0;

    $('#total').val(total.toFixed(2));
  }

  // اعتبر المنتج الأساسي كـ invoice-item
  // (هنلفّه برابّر افتراضي)
  const firstWrapper = $('<div class="invoice-item"></div>');
  $('.item-name:first, .item-price:first, .item-qty:first').closest('.data-field-col').each(function(){
    firstWrapper.append($(this));
  });
  // نرجعهم لمكانهم (عشان يبقوا تحت بعض)
  // ونحط wrapper قبل زر الإضافة
  $('#addItemBtn').closest('.data-field-col').before(firstWrapper);

  // زر إضافة منتج
  $('#addItemBtn').on('click', function () {
    const html = `
      <div class="invoice-item border rounded p-2 mt-2">
        <div class="row">
          <div class="col-sm-12 data-field-col">
            <label>اسم المنتج</label>
            <input type="text" name="items[${itemIndex}][name]" class="form-control item-name" placeholder="اختر المنتج">
          </div>

          <div class="col-sm-12 data-field-col">
            <label>السعر</label>
            <input type="number" name="items[${itemIndex}][price]" class="form-control item-price" value="0" min="0" step="0.01">
          </div>

          <div class="col-sm-12 data-field-col">
            <label>الكميه</label>
            <input type="number" name="items[${itemIndex}][qty]" class="form-control item-qty" value="1" min="0" step="1">
          </div>

          <div class="col-sm-12 data-field-col mt-2">
            <button type="button" class="btn btn-outline-danger w-100 removeItemBtn">حذف المنتج</button>
          </div>
        </div>
      </div>
    `;

    $('#itemsContainer').append(html);
    itemIndex++;
    calcInvoiceTotal();
  });

  // حذف منتج
  $(document).on('click', '.removeItemBtn', function () {
    $(this).closest('.invoice-item').remove();
    calcInvoiceTotal();
  });

  // أي تغيير في الأسعار/الكميات/الخصم -> احسب
  $(document).on('input change', '.item-price, .item-qty, #descount', function () {
    calcInvoiceTotal();
  });

  // أول تحميل
  calcInvoiceTotal();






});
