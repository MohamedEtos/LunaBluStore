
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title ?? 'Lubablu'}}</title>
<meta name="description" content="{{ $description ?? 'متجر لونا بلو للطرح' }}">
<meta name="theme-color" content="#ffffff">


{{-- icons --}}
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('store/images/icons/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('store/images/icons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('store/images/icons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('store/images/icons/favicon-48x48.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('store/images/icons/favicon-16x16.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('store/images/icons/favicon-48x48.png') }}">
<link rel="manifest" href="{{ asset('store/images/icons/site.webmanifest') }}">

<!-- Open Graph -->
<meta property="og:title" content="{{ $title ?? 'LunaBlu' }}">
<meta property="og:description" content="{{ $description ?? 'متجر لونا بلو للطرح' }}">
<meta property="og:image" content="{{ !empty($image) ? (str_starts_with($image, 'http') ? $image : asset($image)) : asset('store/images/icons/logo-01.png') }}">
<meta property="og:url" content="{{ $url ?? url()->current() }}">
<meta property="og:type" content="website">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title ?? 'LunaBlu' }}">
<meta name="twitter:description" content="{{ $description ?? 'متجر لونا بلو للطرح' }}">
<meta name="twitter:image" content="{{ !empty($image) ? (str_starts_with($image, 'http') ? $image : asset($image)) : asset('store/images/icons/logo-01.png') }}">


<!-- Facebook -->


<meta property="fb:app_id" content="1882574705681621">


<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
  src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0&appId=1882574705681621">
</script>


{{-- <script>
    FB.api(
  '/me',
  'GET',
  {"fields":"id,short_name"},
  function(response) {
      // Insert your code here
  }
);
    </script> --}}




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


