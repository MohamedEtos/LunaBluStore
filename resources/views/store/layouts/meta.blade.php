
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="theme-color" content="#ffffff">

<!-- Open Graph -->
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image ?? '' }}">
<meta property="og:url" content="{{ $url ?? '' }}">
<meta property="og:type" content="website">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image ?? '' }}">



<link rel="canonical" href="{{ $url ?? '' }}">



{{-- search engines verification tags --}}

{{-- bing --}}
<meta name="msvalidate.01" content="7250B913D4CB255075A09A239EE816C1" />
{{-- yandex --}}
<meta name="yandex-verification" content="c9c7a3de33a4aae9" />
{{-- seo google meta  --}}
<meta name="robots" content="index, follow">
<meta name="googlebot" content="noai, noimageai">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RPZ3P2T6KM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RPZ3P2T6KM');
</script>





{{-- ajax csrf token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">


