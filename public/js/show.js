$(document).ready(function() {
    $('#myCarousel').carousel({
        interval: false
    });

    var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 100
            };

        src = src.replace('profile', 'original').replace('thumbnail', 'original');

        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
            
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
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
