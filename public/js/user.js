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