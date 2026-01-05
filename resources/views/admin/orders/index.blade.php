@extends('admin.layout.master')
@section('css')

    <link rel="apple-touch-icon" href="{{ asset('admin/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/vendors-rtl.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/file-uploaders/dropzone.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/datatables.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}"> --}}
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/pages/data-list-view.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/custom-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/style-rtl.css') }}">
    <!-- END: Custom CSS-->



@endsection


@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">المنتجات</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">قائمه المنتجات</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-thumb-view" class="data-thumb-view-header">
                    <div class="action-btns d-none">
                        <div class="btn-dropdown mr-1 mb-1">
                            <div class="btn-group dropdown actions-dropodown">
                                <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Hide</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-eye"></i>show</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- dataTable starts -->

                    <div class="table-responsive" >
                        <table class="table data-thumb-view">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>id</th>
                                    <th>ip المستخدم</th>
                                    <th>رقم التلفون </th>
                                    <th> رقم الطلب</th>
                                    <th>اسم المنتج</th>
                                    <th>المشرتيات</th>
                                    <th>الشحن</th>
                                    <th>الاجمالي</th>
                                    <th>المحافظه</th>
                                    <th>التاريخ</th>
                                    <th>اجراء</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($Orderlist as $Order)
                                <tr class="trRow"  data-id_row="{{ $Order->id }}" data-toggle="modal" data-target="#xlarge">
                                    <td></td>

                                    <input type="hidden"  class="full_name{{ $Order->id }}" value=" {{ $Order->address->full_name }} ">
                                    <input type="hidden"  class="phone{{ $Order->id }}" value=" {{ $Order->address->phone }} ">
                                    <input type="hidden"  class="area{{ $Order->id }}" value=" {{ $Order->address->area }} ">
                                    <input type="hidden"  class="floor_number{{ $Order->id }}" value=" {{ $Order->address->floor_number }} ">
                                    <input type="hidden"  class="building{{ $Order->id }}" value=" {{ $Order->address->building }} ">
                                    <input type="hidden"  class="address{{ $Order->id }}" value=" {{ $Order->address->address }} ">

                                    <td class="product-name name{{ $Order->id }}">{{$Order->id  }}</td>
                                    <td class="product-name name{{ $Order->id }}">{{$Order->user_ip}}</td>

                                    <td class="product-category productDetalis{{ $Order->id }}">
                                         <form action="{{ route('Send_whatsapp') }}" method="post" target="_blank">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $Order->id }}">

<a target="_blank"
href="https://wa.me/2{{ $Order->address->phone }}?text={{ urlencode(
"مرحبا
{$Order->address->full_name}

شكرا لطلبك من LunaBlue
رقم طلبك هو: {$Order->order_number}

العنوان : {$Order->address->address} .  {$Order->address->area} . {$Order->address->governorate}

طلبك هو:
" .
collect($Order->items)->map(function($item, $i){
    return ($i+1) . " - " . $item->product->name .
        " ( {$item->quantity} × {$item->price} ) = " .
        ($item->quantity * $item->price) . " ج.م";
})->implode("\n") . "

--------------------
اجمالي الطلب: {$Order->total} ج.م
"
) }}">

@if($Order->payment_status == 'notaccepted')
    <button class="btn btn-success">إرسال رسالة التأكيد</button>
@else
    <button class="btn btn-success">إعادة الإرسال</button>
@endif
</a>
                                    </form>



                                        </td>
                                    <td class="product-category order_number{{ $Order->id }}"> {{ $Order->order_number }} </td>

                                    <td class="product-category product_name{{ $Order->id }}">
                                            @foreach ( $Order->items as $item )
                                                  {{ $loop->iteration }} - {{ $item->product->name }}  ( {{ $item->quantity }} * {{ $item->price }} ) = {{ $item->quantity * $item->price }} ج.م
                                            <br class="mt-1">

                                        @endforeach
                                    </td>
                                    <td class="product-category subtotal{{ $Order->id }}"> {{ $Order->subtotal }} ج.م </td>
                                    <td class="product-category shipping_cost{{ $Order->id }}"> {{ $Order->shipping_cost }} </td>
                                    <td class="product-category total{{ $Order->id }}"> {{ $Order->total }} </td>
                                    <td class="product-category governorate{{ $Order->id }}"> {{ $Order->address->governorate }} </td>
                                    <td class="product-category created_at{{ $Order->id }}"> {{ $Order->created_at->diffForHumans() }} </td>

                                    <td class="product-action">
                                    <span class="action-edit" data-id="{{ $Order->id }}">
                                        <i class="feather icon-edit"></i>
                                    </span>
                                    <span class='del' data-toggle="modal" data-id_del="{{ $Order->id }}" data-target="#danger">
                                        <i class="feather icon-trash"  ></i>
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- dataTable ends -->






                    <!-- add new sidebar starts -->
                <form action='{{ Route('add_product') }}' id='productForm' method='POST' enctype="multipart/form-data">
                        @csrf
                    <input type="hidden"  name="product_id" value='' id="product_id">
                    <div class="add-new-data-sidebar">

                        <div class="overlay-bg"></div>
                        <div class="add-new-data">
                            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                                <div>
                                    <h4 class="text-uppercase">اضافه منتج</h4>
                                </div>
                                <div class="hide-data-sidebar">
                                    <i class="feather icon-x"></i>
                                </div>
                            </div>
                            <div class="data-items pb-3">
                                <div class="data-fields px-2 mt-3">
                                    <div class="row">
                                        <div class="col-sm-12 data-field-col">
                                            <label for="data-name">الاسم</label>
                                            <input required type="text" name="name" class="form-control" id="data-name">
                                        </div>


                                        <div class="col-sm-12 data-field-col">
                                            <label for="data-price">السعر</label>
                                            <input required type="number" name='price' class="form-control" id="data-price">
                                        </div>
                                        <div class="col-sm-12 data-field-col">
                                            <label for="data-price">تفاصيل</label>
                                            <input required type="text" name='desc' class="form-control" id="data-desc">
                                        </div>
                                        <div class="col-sm-12 data-field-col">
                                            <label for="data-price">الكميه المتاحه</label>
                                            <input required type="number" name='stock'class="form-control" id="data-stock">
                                        </div>

                                        <div class="col-sm-12 data-field-col data-list-upload">
                                            {{-- <form  class="dropzone dropzone-area" id="dataListUpload">
                                                <div class="dz-message">Upload Image</div>
                                            </form> --}}
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">الصوره الاساسيه</label>
                                                    <input type="file" value='' id="data-mainImage" name='mainImage' class="form-control-file" id="basicInputFile">
                                                </fieldset>

                                                <div class="col-sm-12 data-field-col">
                                                    <label for="data-price">تعريف الصوره 1</label>
                                                    <input  type="text" name='alt1'class="form-control" id="data-alt1">
                                                </div>

                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">صوره ثانويه</label>
                                                    <input type="file" value='' id="data-img2" name='img2' class="form-control-file" id="basicInputFile">
                                                </fieldset>

                                                <div class="col-sm-12 data-field-col">
                                                    <label for="data-price">تعريف الصوره 2</label>
                                                    <input  type="text" name='alt2'class="form-control" id="data-alt2">
                                                </div>
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">صوره ثانويه</label>
                                                    <input type="file" value='' id="data-img3" name='img3' class="form-control-file" id="basicInputFile">
                                                </fieldset>
                                                <div class="col-sm-12 data-field-col">
                                                    <label for="data-price">تعريف الصوره 1</label>
                                                    <input  type="text" name='alt3'class="form-control" id="data-alt3">
                                                </div>
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">صوره ثانويه</label>
                                                    <input type="file" value='' id="data-img4" name='img4' class="form-control-file" id="basicInputFile">
                                                </fieldset>
                                                <div class="col-sm-12 data-field-col">
                                                    <label for="data-price">تعريف الصوره 1</label>
                                                    <input  type="text" name='alt4'class="form-control" id="data-alt4">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                <div class="add-data-btn">
                                    <button class="btn btn-primary">تاكيد</button>
                                </div>
                                <div class="cancel-data-btn">
                                    <button class="btn btn-outline-danger">الغاء</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>


                    <!-- add new sidebar ends -->
                </section>
                <!-- Data list view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

        {{-- modals  --}}

        <div class="modal-danger mr-1 mb-1 d-inline-block">
            <!-- Modal -->

            <form action="" class="modal fade text-left" method="POST" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                @csrf
                <input name="productId" id="prod_id" type="hidden" value="">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger white">
                            <h5 class="modal-title" id="myModalLabel120">تاكيد الحذف</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            هل انت متاكد من حذف المنتج !
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">الغاء</button>
                            <input  type="submit" value='تاكيد' class="btn btn-outline-danger" >
                        </div>
                    </div>
                </div>
            </form>



            <div class="modal-size-xl mr-1 mb-1 d-inline-block">
                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel16">تفاصيل الطلب</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <div class="row">
                                        <div class="col-1" >
                                            <img class=" mt-1 w-100 " src="{{ asset('store/images/product-13.avif') }}" alt="">
                                        </div>
                                        <div class="col-5">
                                            <div> #:<span id="order_number"></span></div>
                                            <div>اسم العميل:<span id="full_name"></span></div>
                                            <div>رقم التلفون:<span id="phone"></span></div>
                                            <div> المحافظه:<span id="governorate"></span></div>
                                            <div> المنطقه:<span id="area"></span></div>
                                            <div> العنوان:<span id="address"></span></div>
                                            <div> عقار:<span id="building"></span></div>
                                            <div> الدور:<span id="floor_number"></span></div>
                                        </div>
                                        <div class="col-5">
                                            <div> المنتج:

                                                <div><span id="product_name"></span></div>

                                            </div>
                                            <div> قيمه الطلب:<span id="subtotal" class="fw-bold"></span></div>
                                            <div>  الشحن:<span id="shipping_cost"></span></div>
                                            <div class="border-top mb-1 pt-1 h6">  المجموع:<b id="total"></b></div>

                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-4">
                                            ملاحظات:<span id="note"></span>
                                        </div>
                                        <div class="col-4">
                                            تاريخ الطلب:<span id="created_at" class="text-info"></span>
                                        </div>
                                        <div class="col-4">
                                             الحاله:<span id="status" class="success">تم ارسال رساله التاكيد</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




@endsection




@section('script')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('admin/js/core/app.js') }}"></script>
    <script src="{{ asset('admin/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->


    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin/js/scripts/ui/data-list-view.js') }}"></script>
    <script src="{{ asset('admin/js/scripts/ui/edit-view.js') }}"></script>
    <!-- END: Page JS-->


    {{-- modals --}}
    <script src="{{ asset('admin/js/scripts/modal/components-modal.js') }}"></script>


<script>

$(document).ready(function() {
  "use strict"

    $('.del').on("click",function(){
        let productId = $(this).data('id_del');
        // on del
        $('#danger').attr(
            'action',
            "{{ route('destroy', ':id') }}".replace(':id', productId)
        );
        $('#prod_id').val(productId);


    });

    // $('.trRow').on("click",function(){
    //     let id_send = $(this).data('id_send');
    //     $('#danger').attr(
    //         'action',
    //         "{{ route('destroy', ':id') }}".replace(':id', productId)
    //     );
    //     $('#prod_id').val(productId);


    // });


      // On click more dedtails
    $('.trRow').on("click",function(e){
        e.stopPropagation();

        let productId = $(this).data('id_row');


        $('#product_name').text($('.product_name'+productId).text());
        $('#subtotal').text($('.subtotal'+productId).text());
        $('#shipping_cost').text($('.shipping_cost'+productId).text());
        $('#total').text($('.total'+productId).text());
        $('#governorate').text($('.governorate'+productId).text());
        $('#created_at').text($('.created_at'+productId).text());
        $('#full_name').text($('.full_name'+productId).val());
        $('#phone').text($('.phone'+productId).val());
        $('#area').text($('.area'+productId).val());
        $('#floor_number').text($('.floor_number'+productId).val());
        $('#building').text($('.building'+productId).val());
        $('#address').text($('.address'+productId).val());




    });
      // On Edit
    $('.action-edit').on("click",function(e){
        e.stopPropagation();
        let productId = $(this).data('row_id');


        $('#data-name').val($('.name'+productId).text());
        $('#data-price').val($('.price'+productId).text());
        $('#data-stock').val($('.stock'+productId).text());
        $('#data-desc').val($('.desc'+productId).text());
        $('#data-fabric_type').val($('.fabric_type'+productId).text());
        $('#data-cat').val($('.cat'+productId).text());
        $('#data-desc').val($('.productDetalis'+productId).text());
        $(".add-new-data").addClass("show");
        $(".overlay-bg").addClass("show");





        // تغيير action
            $('#productForm').attr(
            'action',
            "{{ route('edit_product', ':id') }}".replace(':id', productId)
            );

        // وضع id المنتج
        $('#product_id').val(productId);

        // تغيير العنوان
        $('.new-data-title h4').text('تعديل منتج');

        // تغيير زر التأكيد
        $('.add-data-btn button').text('تعديل');

        // إظهار الفورم لو مخفي
        $('.add-new-data-sidebar').addClass('show');

        $('input[name="name"]').val();

    });

});



</script>





@endsection
