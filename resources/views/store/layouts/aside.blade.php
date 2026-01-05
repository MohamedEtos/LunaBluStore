	<aside class="wrap-sidebar js-sidebar">
		<div class="s-full js-hide-sidebar"></div>

		<div class="sidebar flex-col-l p-t-22 p-b-25">
			<div class="flex-r w-full p-b-30 p-r-27">
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
				<ul class="sidebar-link w-full">
					<li class="p-b-13">
						<a href="{{ route('home') }}" class="stext-102 cl2 hov-cl1 trans-04">
							الرئيسية
						</a>
					</li>


					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
							تتبع طلبك
						</a>
					</li>



					<li class="p-b-13">
						<a href="https://wa.me/201554063260" target="_blank" class="stext-102 cl2 hov-cl1 trans-04">
							المساعده
						</a>
					</li>
				</ul>

				<div class="sidebar-gallery w-full p-tb-30">
					<span class="mtext-101 cl5">
						@ LunaBlu
					</span>

					<div class="flex-w flex-sb p-t-36 gallery-lb">
						<!-- item gallery sidebar -->
                        @foreach ($GlobalProductImg as $images )
						<div class="wrap-item-gallery m-b-10">
							<a class="item-gallery bg-img1" href="{{asset($images->mainImage)}}" data-lightbox="gallery"
							style="background-image: url('{{asset($images->mainImage)}}');"></a>
						</div>

                        @endforeach


					</div>
				</div>

				<div class="sidebar-gallery w-full">
					<span class="mtext-101 cl5">
						About Us
					</span>

					<p class="stext-108 cl6 p-t-27">
                    💙 About Us | من نحن

                    لونا بلو هو متجر متخصص في تقديم طرح حريمي أنيقة تجمع بين البساطة، الجودة، والذوق العصري. نحرص دائمًا على اختيار خامات مميزة وتصميمات تناسب مختلف الأذواق والمناسبات، مع توفير تجربة تسوق سهلة وأسعار مناسبة.

                    في لونا بلو، الأناقة تبدأ من التفاصيل
					</p>
				</div>
			</div>
		</div>
	</aside>
