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

    $("input:text[name$='title']").simplyCountable({
        counter: "#counter-title",
        maxCount: 255,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
            console.log(counter.parents().eq(2));
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });

    $("textarea[name$='description']").simplyCountable({
        counter: "#counter-description",
        maxCount: 255,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });

    $("input:text[name$='request']").simplyCountable({
        counter: "#counter-request",
        maxCount: 255,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });
});
