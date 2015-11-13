$(document).ready(function() {
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
});