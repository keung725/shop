$(".sp-wrap").append('<div class="sp-large"></div><div class="sp-thumbs sp-tb-active"></div>');
$(".sp-wrap a").appendTo(".sp-thumbs");
$(".sp-thumbs a:first").addClass("sp-current").clone().removeClass("sp-current").appendTo(".sp-large");
$(".sp-wrap").css("display", "inline-block");
var slideTiming = 300;
var maxWidth = $(".sp-large img").width();
$(".sp-thumbs").live("click", function (e) {
    e.preventDefault()
});
$(".sp-tb-active a").live("click", function (e) {
    $(".sp-current").removeClass();
    $(".sp-thumbs").removeClass("sp-tb-active");
    $(".sp-zoom").remove();
    var t = $(".sp-large").height();
    $(".sp-large").css({overflow: "hidden", height: t + "px"});
    $(".sp-large a").remove();
    $(this).addClass("sp-current").clone().hide().removeClass("sp-current").appendTo(".sp-large").fadeIn(slideTiming, function () {
        var e = $(".sp-large img").height();
        $(".sp-large").height(t).animate({height: e}, "fast", function () {
            $(".sp-large").css("height", "auto")
        });
        $(".sp-thumbs").addClass("sp-tb-active")
    });
    e.preventDefault()
});
$(".sp-large a").live("click", function (e) {
    var t = $(this).attr("href");
    $(".sp-large").append('<div class="sp-zoom"><img src="' + t + '"/></div>');
    $(".sp-zoom").fadeIn();
    $(".sp-large").css({left: 0, top: 0});
    e.preventDefault()
});
$(document).ready(function () {
    $(".sp-large").mousemove(function (e) {
        var t = $(".sp-large").width();
        var n = $(".sp-large").height();
        var r = $(".sp-zoom").width();
        var i = $(".sp-zoom").height();
        var s = $(this).parent().offset();
        var o = e.pageX - s.left;
        var u = e.pageY - s.top;
        var a = Math.floor(o * (t - r) / t);
        var f = Math.floor(u * (n - i) / n);
        $(".sp-zoom").css({left: a, top: f})
    }).mouseout(function () {
    })
});
$(".sp-zoom").live("click", function (e) {
    $(this).fadeOut(function () {
        $(this).remove()
    })
})