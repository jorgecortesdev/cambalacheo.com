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

    $("input:password[name$='password']").simplyCountable({
        counter: "#counter-password",
        maxCount: 60,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
            console.log(counter.parents().eq(2));
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });

    $("input:password[name$='password_confirmation']").simplyCountable({
        counter: "#counter-confirmation",
        maxCount: 60,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
            console.log(counter.parents().eq(2));
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });
});

function loadCities(state_id, disable) {
    $.ajax({
        url: '/cities/' + state_id
    }).done(function(cities) {
        var select = $('select#city');
        select.empty();
        select.append('<option value="">-- Seleccionar --</option>');
        $.each(cities.cities, function(i, item) {
            select.append('<option value="' + item.id + '">' + item.name + '</option>');
        });

        if (disable) {
            select.prop('disabled', false);
        }
    });
}