@extends('admin.layout.master')
@section('css')

    <link rel="apple-touch-icon" href="{{ asset('admin/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/pages/data-list-view.css') }}">
    <!-- END: Page CSS-->



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

                    <div class="table-responsive">
                        <table class="table data-thumb-view">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>الصوره</th>
                                    <th>الاسم</th>
                                    <th>تفاصيل</th>
                                    <th>المشاهدات</th>
                                    <th>الحاله</th>
                                    <th>الكميه</th>
                                    <th>السعر</th>
                                    <th>اجراء</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($Productlist as $Product)
                                <tr>
                                    <td></td>
                                    <td class="product-img "><img src="{{ asset($Product->product_img_p->mainImage) }}" alt="Img placeholder">
                                    </td>
                                    <td class="product-name name{{ $Product->id }}">{{$Product->name}}</td>
                                    <td class="product-category productDetalis{{ $Product->id }}"> {{ $Product->productDetalis }} </td>
                                    <td>
                                        {{ $Product->views }}
                                    </td>
                                    <td>
                                            <div class="chip toggle-status {{
                                                $Product->append == 1 && $Product->stock >= 5 ? 'chip-success' :
                                                ($Product->append == 0 ? 'chip-warning' :
                                                ($Product->stock < 5 ? 'chip-danger' : ''))
                                            }}" data-id="{{ $Product->id }}" style="cursor: pointer;">
                                            <div class="chip-body">
                                                <div class="chip-text">
                                                    {{
                                                        $Product->append == 1 && $Product->stock >= 5 ? 'نشط' :
                                                        ($Product->append == 0 ? 'متوقف' :
                                                        ($Product->stock < 5 ? 'المخزون اقل من 5' : ''))
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-stock stock{{ $Product->id }}"> {{ $Product->stock }} </td>
                                    <td class="product-price price{{ $Product->id }}"> {{ $Product->price }} </td>
                                    <td class="product-action">
                                    <span class="action-edit" data-id="{{ $Product->id }}">
                                        <i class="feather icon-edit"></i>
                                    </span>
                                    <span class='del' data-toggle="modal" data-id_del="{{ $Product->id }}" data-target="#danger">
                                        <i class="feather icon-trash"  ></i>
                                    </span>
                                    <!-- Hidden Meta Data for JS -->
                                    <span class="d-none meta_title{{ $Product->id }}">{{ $Product->meta_title }}</span>
                                    <span class="d-none meta_description{{ $Product->id }}">{{ $Product->meta_description }}</span>
                                    <span class="d-none meta_keywords{{ $Product->id }}">{{ $Product->meta_keywords }}</span>
                                    <!-- Hidden Data for Edit Form Population -->
                                    <span class="d-none cat{{ $Product->id }}">{{ $Product->cat_id }}</span>
                                    <span class="d-none fabric_type{{ $Product->id }}">{{ $Product->fabric_id }}</span>
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
                                            <label for="data-category"> القسم </label>
                                            <select class="form-control" name='cat' id="data-cat">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12 data-field-col">
                                            <label for="data-status">نوع القماش </label>
                                            <select class="form-control" name='fabric_type' id="data-fabric_type">
                                                @foreach ($fabrics as $fabric)
                                                    <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                                                @endforeach
                                            </select>
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

                                                <div class="col-sm-12 data-field-col">
                                                    <h4 class="mb-1 mt-2">SEO Meta Data</h4>
                                                </div>
                                                <div class="col-sm-12 data-field-col">
                                                    <label for="meta_title">Meta Title</label>
                                                    <input type="text" name='meta_title' class="form-control" id="data-meta_title">
                                                </div>
                                                <div class="col-sm-12 data-field-col">
                                                    <label for="meta_description">Meta Description</label>
                                                    <textarea name='meta_description' class="form-control" id="data-meta_description"></textarea>
                                                </div>
                                                <div class="col-sm-12 data-field-col">
                                                    <label for="meta_keywords">Meta Keywords</label>
                                                    <input type="text" name='meta_keywords' class="form-control" id="data-meta_keywords" placeholder="keyword1, keyword2, ...">
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
        </div>




@endsection




@section('script')


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <!-- END: Page Vendor JS-->




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


      // On Edit
    $('.action-edit').on("click",function(e){
        e.stopPropagation();
        let productId = $(this).data('id');


        $('#data-name').val($('.name'+productId).text().trim());
        $('#data-price').val($('.price'+productId).text().trim());
        $('#data-stock').val($('.stock'+productId).text().trim());
        // $('#data-desc').val($('.desc'+productId).text().trim()); // Removed redundant call
        $('#data-fabric_type').val($('.fabric_type'+productId).text().trim());
        $('#data-cat').val($('.cat'+productId).text().trim());
        $('#data-desc').val($('.productDetalis'+productId).text().trim());

        // Populate Meta Data
        $('#data-meta_title').val($('.meta_title'+productId).text());
        $('#data-meta_description').val($('.meta_description'+productId).text());
        $('#data-meta_keywords').val($('.meta_keywords'+productId).text());

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

$('.toggle-status').on('click', function() {
    var chip = $(this);
    var productId = chip.data('id');
    var chipText = chip.find('.chip-text');

    $.ajax({
        url: "{{ route('product.toggle_status', ':id') }}".replace(':id', productId),
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            if (response.success) {
                // Remove old classes
                chip.removeClass('chip-success chip-warning chip-danger');

                // Apply new class and text based on logic
                if (response.append == 0) {
                    chip.addClass('chip-warning');
                    chipText.text('متوقف');
                } else if (response.stock < 5) {
                    chip.addClass('chip-danger');
                    chipText.text('المخزون اقل من 5');
                } else {
                    chip.addClass('chip-success');
                    chipText.text('نشط');
                }
                
                // Show toast notification
                if (response.append == 0) {
                     toastr.warning(response.message, 'تنبيه');
                } else {
                     toastr.success(response.message, 'تمت العملية');
                }
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            toastr.error('حدث خطأ أثناء تحديث الحالة', 'خطأ');
        }
    });
});



</script>





@endsection
