<section class="slider-hero-wrapper">
    <div class="slider-hero scrollme">
        <a class="arrow-left" href="#"></a> <a class="arrow-right" href="#"></a>

        <div class="swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" >
                @foreach($HomeBanners as $HomeBanner)
                <div class="swiper-slide slider-hero-bg " style="background-image: url({{$HomeBanner->image_path}})">
                    @if($HomeBanner->link_path != '')
                        <a href="{{$HomeBanner->link_path}}" style="cursor: pointer;">
                    @endif
                        <!-- Any HTML content of the first slide goes here -->
                            <div class="slider-hero-content has-overly-shade hw100">
                                <div class="display-table hw100">
                                    <div class="display-table-cell hw100">
                                        <div class="container ">
                                            <div class="slider-hero-caption has-dark-bg max-60 center-block text-center animateme"
                                                 data-when="span"

                                                 data-from="0"
                                                 data-to="0.7"
                                                 data-opacity="0"
                                                 data-translatey="200"
                                                 scale="0"
                                                 data-crop="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @if($HomeBanner->link_path)
                        </a>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="swiper-pagination swiper-pagination-v"></div>
        </div>
    </div>
</section>
<!-- /.slider-hero-wrapper  -->


