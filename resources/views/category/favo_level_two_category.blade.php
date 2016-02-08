<section class="section-hero section-gray" id="section-category">
    <div class="container">

        <div class="hero-section-header ">
            <h3 class="hero-section-title">熱門分類</h3>
        </div>

        <div class="row row-centered">
            @foreach($levelTwoCategories as $levelTwoCategorie)
                <div class="block-explore col-centered col-sm-4 col-xs-4 col-xs-min-12">
                    <div class="inner">
                        <a class="overly hw100" href="">
                            <span class="explore-title"> {{$levelTwoCategorie->title}}</span>
                        </a>
                        <a href="" class="img-block"> <img alt="img" src="{{$levelTwoCategorie->image_path}}"
                                                           class="img-responsive"></a>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
</section>