<section class="section-hero section-gray" id="section-category">
    <div class="container">

        <div class="hero-section-header ">
            <h3 class="hero-section-title">最受關注總類</h3>
        </div>

        <div class="row row-centered">
            @foreach($Categories as $Category)
            <div class="block-explore col-centered col-sm-4 col-xs-4 col-xs-min-12">
                <div class="inner">
                    <a class="overly hw100" href="">
                        <span class="explore-title"> {{$Category->title}}</span>
                    </a>
                    <a href="" class="img-block"> <img alt="img" src="{{$Category->image_path}}"
                                                        class="img-responsive"></a>
                </div>
            </div>

            @endforeach


        </div>
    </div>
</section>