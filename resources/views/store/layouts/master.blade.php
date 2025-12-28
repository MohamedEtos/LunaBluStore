<!doctype html>
<html lang="ar">
<head>
    <!-- Head -->
    @include('store.layouts.meta')
    @include('store.layouts.head')
    @yield('head')

</head>


<body class="animsition">
  <main id="main-content">
    <div id="page-loader" aria-hidden="true">
        <span class="spinner"></span>
    </div>


    @include('store.layouts.navbar')
    @include('store.layouts.aside')
    @include('store.layouts.cart')


    @yield('content')


    @include('store.layouts.footer')
    @include('store.layouts.scripts')
    @include('store.layouts.cartScript')
    
    @yield('script')
  </main>
</body>

</html>
