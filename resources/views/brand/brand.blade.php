<section class="section-hero white-bg" id="section-brand">
    <div class="container">
        <div class="width100 section-block">
            <h3 class="section-title"><span> 品牌</span> <a id="nextBrand" class="link pull-right carousel-nav"> <i
                            class="fa fa-angle-right"></i></a> <a id="prevBrand" class="link pull-right carousel-nav"> <i
                            class="fa fa-angle-left"></i> </a></h3>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="no-margin brand-carousel owl-carousel owl-theme">
                        @foreach($Brands as $Brand)
                            <li><img src="{{$Brand->image_path}}" alt="i{{$Brand->title}}"></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.section-block-->
    </div>
</section>