<!doctype html>
<html lang="ar">
<head>
    @yield('head')
<!-- Head -->
@include('store.layouts.head')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RPZ3P2T6KM"></script>
{{-- bing --}}
<meta name="msvalidate.01" content="7250B913D4CB255075A09A239EE816C1" />
{{-- yandex --}}
<meta name="yandex-verification" content="c9c7a3de33a4aae9" />
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RPZ3P2T6KM');
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">

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
