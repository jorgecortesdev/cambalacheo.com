$(document).ready(function() {
    $('#main-carousel').on('slid.bs.carousel', function(e) {
        var carouselData = $(this).data('bs.carousel');
        var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
        $('#main-carousel-thumbs ul li').removeClass('active');
        $('#main-carousel-thumbs ul li[data-slide-to="'+currentIndex+'"]').addClass('active');
    });

    $('#main-carousel-thumbs ul li').on('click', function() {
        $('#main-carousel-thumbs ul li').removeClass('active');
        $(this).addClass('active');
    });

    $('.replay').click(function() {
        $('.form-replay').hide();
        $('.send').hide();
        $('.replay').show();

        var frm = $(this).data('form');
        $("#" + frm).show();
        $("#" + frm).find('input:text:visible:first').focus();

        var send = $(this).next('.send');
        send.show();

        $(this).hide();
        return false;
    });

    $('.send').click(function() {
        var frm = $(this).data('form');
        $("#" + frm).submit();
        return false;
    });
});
