(function($) {

    var o = $({});

    $.subscribe = function() {
        o.on.apply(o, arguments);
    }

    $.unsubscribe = function() {
        o.off.apply(o. arguments);
    }

    $.publish = function() {
        o.trigger.apply(o, arguments);
    }

})(jQuery);

// Add a spinner to all buttons that have the attribute 'data-spinner'
(function() {
    $('button[data-spinner]').on('click', function() {
        var $this = $(this);

        $this.attr('data-loading-text', '<i class="fa fa-cog fa-spin"></i> Enviando...');
        $this.button('loading');
    });
})();

// Add a counter for the input inside of the div.input-counter class
// to specify the maxCount number use data-max-count attribute
(function() {
    var container = $('div.input-counter');

    container.each(function() {
        var $this = $(this);
        var input = $this.find('input[type=text], input[type=email], textarea');
        var counterId = 'counter-' + input.attr('name');
        var maxCount = $this.data('max-count');
        var counter = $('<span></span>').attr('id', counterId);

        $this.append($('<div></div>').text('/' + maxCount).prepend(counter));

        input.simplyCountable({
            counter: '#' + counter.attr('id'),
            maxCount: maxCount,
            countDirection: 'up',
            onOverCount: function(count, contable, counter) {
                counter.parents().eq(2).addClass("has-error");
            },
            onSafeCount: function(count, countable, counter) {
                counter.parents().eq(2).removeClass("has-error");
            }
        });
    });
})();