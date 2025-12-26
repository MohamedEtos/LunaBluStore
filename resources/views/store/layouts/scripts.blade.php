
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	{{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="{{ asset('store/vendor/animsition/js/animsition.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js') }}"></script> --}}
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/bootstrap/js/popper.js') }}"></script>
	{{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js') }}"></script> --}}
	<script src="{{ asset('store/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	{{-- <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-v4.0.0-alpha@0.1.6/dist/js/bootstrap.min.js') }}"></script> --}}
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/select2/select2.min.js') }}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('store/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/slick/slick.min.js') }}"></script>
	<script src="{{ asset('store/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/parallax100/parallax100.js') }}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
	{{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js') }}"></script> --}}
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/sweetalert/sweetalert.min.js') }}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('store/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	{{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.1.0/perfect-scrollbar.min.js') }}"></script> --}}
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});

        $('.slick1').on('init', function(event, slick){
            $('.slick1-dots li').attr('role', 'tab');
            $('.slick1-dots li').each(function(index){
                $(this).attr('id', 'tab-'+(index+1));
                $(this).attr('aria-controls', 'panel-'+(index+1));
                if(index === 0) $(this).attr('aria-selected', 'true');
                else $(this).attr('aria-selected', 'false');
            });
        });


	</script>
<!--===============================================================================================-->
	<script src="{{ asset('store/js/main.js') }}"></script>

