@extends('store.layouts.master')
@section('content')




@endsection

@section('script')
<script>
    (function ($) {
    "use strict";
        var headerDesktop = $('.container-menu-desktop');
        $(headerDesktop).addClass('fix-menu-desktop');

    })(jQuery);
</script>




@endsection
