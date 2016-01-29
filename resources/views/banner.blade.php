<section class="slider-hero-wrapper" ng-app="HomeBanner" ng-controller="HomeBannerController">
    <div class="slider-hero scrollme">
        <a class="arrow-left" href="#"></a> <a class="arrow-right" href="#"></a>

        <div class="swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" ng-repeat='HomeBanner in HomeBanners' >
                <div class="swiper-slide slider-hero-bg "  ng-style="{'background-image':'url(<% HomeBanner.image_path %>)'}">
                    <!-- Any HTML content of the first slide goes here -->
                    <div class="slider-hero-content has-overly-shade  hw100"
                         style="background-color: rgba(0, 0, 0, 0.1);">
                        <div class="display-table hw100">
                            <div class="display-table-cell hw100">
                                <div class="container ">
                                    <div class="slider-hero-caption has-dark-bg text-left animateme" data-when="span"

                                         data-from="0"
                                         data-to="0.7"
                                         data-opacity="0"
                                         data-translatey="200"
                                         scale="0"
                                         data-crop="true">

                                        <h2 class="slide-caption-title ">Summer <span
                                                    class="lighter"> Essentials </span></h2>

                                        <div class="slide-caption-text">
                                            <p> Discover thousands of products about Summer Essentials </p>
                                            <a href="category.html" class="btn btn-stroke lite">Shop Now</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-pagination swiper-pagination-v"></div>
        </div>
    </div>
</section>
<!-- /.slider-hero-wrapper  -->


@section('page-script')
    <script type="text/javascript">
        var app = angular.module('HomeBanner', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('HomeBannerController', function($scope, $http) {

            $scope.HomeBanners = [];
            $scope.loading = false;

            $scope.init = function () {
                $scope.loading = true;
                $http.get('/api/homebanners/show').success(function (data, status, headers, config) {
                    $scope.HomeBanners = data;
                    $scope.loading = false;
                });
            }
            $scope.init();
        });

    </script>
@stop