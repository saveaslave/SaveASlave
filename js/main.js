$(document).ready(function(){
    $(window).bind('scroll', function() {
        var navHeight = $("#jumbotron").height();
        ($(window).scrollTop() > navHeight) ? $('nav').addClass('goToTop') : $('nav').removeClass('goToTop');
    });
});
