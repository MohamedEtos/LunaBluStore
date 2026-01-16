
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

<head>
@include('admin.layout.head')

    @yield('css')

    {{-- toastr --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css-rtl/plugins/extensions/toastr.css') }}">
    
</head>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    @include('admin.layout.navbar')
    @include('admin.layout.aside')


    @yield('content')


    @include('admin.layout.footer')

    @yield('script')
    <script src="{{ asset('admin/js/scripts/notifications.js') }}"></script>

        <script src="{{ asset('admin/vendors/js/extensions/toastr.min.js') }}"></script>
    	@if(Session::has('success'))
            <script>toastr.success('{{ session('success') }}', 'تمت العمليه ');</script>
         @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error("{{ $error }}", "خطا");
                </script>
            @endforeach
        @endif

</body>

</html>
