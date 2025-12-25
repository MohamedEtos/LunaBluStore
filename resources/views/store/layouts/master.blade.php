<!doctype html>
<html lang="ar">
<head>
<!-- Head -->
@include('store.layouts.head')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RPZ3P2T6KM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RPZ3P2T6KM');
</script>
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

    @yield('script')
  </main>
</body>

</html>
