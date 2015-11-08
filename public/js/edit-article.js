$(document).ready(function() {
    $('.remove-image').click(function(e) {
        e.preventDefault();

        var image = $(this).parent().find('img');
        image.addClass('image-overlay');

        var image_id = image.data('image-id');

        $('<input>').attr({
            type: 'hidden',
            name: 'remove_images[]',
            value: image_id
        }).appendTo('form');

        $('<span>').attr({
            class: 'fa fa-check text-success'
        }).appendTo($(this).parent());

        $(this).hide();
        $(this).unbind('click');
    });
});
