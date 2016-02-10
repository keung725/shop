
<div class="w100 sectionCategory">
    <div class="container">
        <div class="sectionCategoryIntro text-center">
            <h1>熱門分類</h1>
        </div>

        <div class="row subCategoryList clearfix">
            @foreach($levelTwoCategories as $levelTwoCategory)
            <div class="col-md-2 col-sm-3 col-xs-4  col-xs-mini-6  text-center ">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="sub-category.html"><img
                                src="{{$levelTwoCategory->image_path}}" class="img-rounded " alt="img"> </a> <a
                            class="subCategoryTitle"><span>{{$levelTwoCategory->title}}</span></a></div>
            </div>
            @endforeach
        </div>
        <!--/.row-->

    </div>
    <!--/.container-->
</div>
<!--/.sectionCategory-->