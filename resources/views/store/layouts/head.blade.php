

        <x-meta
            title="{{ $title ?? '' }}"
            description="{{ $description ?? '' }}"
            image="{{ $image ?? null }}"
        />

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('store/images/icons/favicon.png') }}"/>

    <!-- ===== PRECONNECT FONTS ===== -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    <link rel="preload"
        href="{{ asset('store/fonts/Alexandria/alexandria-v6-latin-regular.woff2') }}"
        as="font"
        type="font/woff2"
        crossorigin>

    <style>
    @font-face {
    font-family: 'Alexandria';
    src: url('{{ asset('store/fonts/Alexandria/alexandria-v6-latin-regular.woff2') }}') format('woff2');
    font-weight: 400;
    font-style: normal;
    font-display: swap;
    }
    </style>

    {{-- <!-- ===== GOOGLE FONTS (render-safe) ===== --> --}}
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Noto+Sans+Arabic:wght@100..900&display=swap"> --}}

    <!-- ===== CRITICAL CSS ===== -->
    {{-- <link rel="stylesheet" href="{{ asset('store/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('store/css/main.css') }}"> --}}

    <link rel="preload" href="{{ asset('store/vendor/bootstrap/css/bootstrap.min.css') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('store/css/util.css') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('store/css/main.css') }}" as="style" onload="this.rel='stylesheet'">

    <noscript>
    <link rel="stylesheet" href="{{ asset('store/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('store/css/main.css') }}">
    </noscript>

    <link rel="stylesheet" href="{{ asset('store/vendor/slick/slick.css') }}">

    <link rel="stylesheet" href="{{ asset('store/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <!-- ===== DEFERRED CSS (non-critical) ===== -->
    <link rel="stylesheet" href="{{ asset('store/vendor/animate/animate.css') }}"
        media="print" onload="this.media='all'">

    <link rel="stylesheet" href="{{ asset('store/vendor/css-hamburgers/hamburgers.min.css') }}"
        media="print" onload="this.media='all'">

    {{-- <link rel="stylesheet" href="{{ asset('store/vendor/animsition/css/animsition.min.css') }}"
        media="print" onload="this.media='all'"> --}}

    <link rel="stylesheet" href="{{ asset('store/vendor/select2/select2.min.css') }}"
        media="print" onload="this.media='all'">

    <link rel="stylesheet" href="{{ asset('store/vendor/daterangepicker/daterangepicker.css') }}"
        media="print" onload="this.media='all'">



    <link rel="stylesheet" href="{{ asset('store/vendor/MagnificPopup/magnific-popup.css') }}"
        media="print" onload="this.media='all'">

    <link rel="stylesheet" href="{{ asset('store/vendor/perfect-scrollbar/perfect-scrollbar.css') }}"
        media="print" onload="this.media='all'">

    <!-- ===== PRELOAD LCP IMAGES ===== -->
    <link rel="preload" as="image" href="{{ asset('store/images/slide-05.avif') }}" type="image/avif" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('store/images/slide-06.avif') }}" type="image/avif" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('store/images/slide-07.avif') }}" type="image/avif" fetchpriority="high">
