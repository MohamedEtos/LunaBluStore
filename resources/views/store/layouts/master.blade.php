<!doctype html>
<html lang="ar">
<head>
    <!-- Head -->
    @include('store.layouts.meta')
    @include('store.layouts.head')
    
    @if(isset($setting))
    @php
        $primary = $setting->primary_color ?? '#f0287d';
        $secondary = $setting->secondary_color ?? '#222222';
        $hover = $setting->hover_color ?? '#f0287d';

        // Convert hex to rgb for opacity usage
        $hex = ltrim($primary, '#');
        if(strlen($hex) == 3) { $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2]; }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $primaryRgb = "$r, $g, $b";
    @endphp
    <style>
        :root {
            --primary-color: {{ $primary }};
            --secondary-color: {{ $secondary }};
            --hover-color: {{ $hover }};
            --primary-rgb: {{ $primaryRgb }};
        }

        /* Generic Classes */
        .bg1 { background-color: var(--primary-color) !important; }
        .cl1 { color: var(--primary-color) !important; }
        
        /* Buttons and Hover Effects */
        .hov-btn1:hover { 
            background-color: var(--secondary-color) !important; 
            border-color: var(--secondary-color) !important; 
            color: #fff !important; 
        }
        .hov-btn2:hover {
            border-color: var(--primary-color) !important;
            color: var(--primary-color) !important;
        }
        .hov-btn3:hover { 
            background-color: var(--hover-color) !important; 
            border-color: var(--hover-color) !important; 
            color: #fff !important; 
        }
        .hov-tag1:hover {
            border-color: var(--primary-color) !important;
            color: var(--primary-color) !important;
        }

        /* Loaders and Overlays */
        #page-loader { background: var(--primary-color) !important; }
        .loader05 { border-color: var(--primary-color) !important; }
        
        .block1-txt:hover { 
            background-color: rgba(var(--primary-rgb), 0.7) !important; 
        }
        .hov-ovelay1::after {
            background-color: rgba(var(--primary-rgb), 0.8) !important;
        }

        /* Components */
        .btn-back-to-top, .main-menu-m, .icon-header-noti::after, .swal-button, .bbc { 
            background-color: var(--primary-color) !important; 
        }
        .btn-back-to-top:hover {
            background-color: var(--primary-color) !important; 
            opacity: 1;
        }
        
        .main-menu > li:hover > a, 
        .filter-link-active, 
        .filter-link:hover, 
        a.filter-link-active { 
            color: var(--primary-color) !important; 
        }
        
        .filter-link-active, .filter-link:hover {
            border-bottom-color: var(--primary-color) !important;
        }

        /* Isotope Active Filter */
        .how-active1 {
            color: #333;
            border-color: var(--primary-color) !important;
        }

        /* Mobile Menu */
        .header-v3 .fix-menu-desktop .wrap-menu-desktop,
        .show-filter:hover:after,
        .show-search:hover:after {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        
        /* Misc */
        .arrow-slick1:hover { color: var(--primary-color) !important; }
        .label1::after { background-color: var(--primary-color) !important; }
        
        /* Selection */
        ::selection {
            background: var(--primary-color) !important;
            color: #fff;
        }

        /* Fixed Mobile Header */
        @media (max-width: 992px) {
            .wrap-header-mobile {
                position: fixed;
                top: 0;
                left: 0; 
                width: 100%;
                z-index: 9999;
            }
            .menu-mobile {
                position: fixed;
                top: 70px; /* wrap-header-mobile height */
                width: 100%;
                z-index: 9998;
                overflow-y: auto;
                max-height: calc(100vh - 70px);
            }
            /* Add padding to prevent content from hiding behind fixed header */
            body {
                padding-top: 70px;
            }
        }
    </style>
    @endif
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
