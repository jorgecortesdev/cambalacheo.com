$(document).ready(function() {
    $("input:text[name$='name']").simplyCountable({
        counter: "#counter-name",
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

    $("input[name$='email']").simplyCountable({
        counter: "#counter-email",
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

    $("textarea[name$='message']").simplyCountable({
        counter: "#counter-message",
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