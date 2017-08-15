
jQuery(function(){
    jQuery('#search-box').change(function(){
        var user_country = jQuery("#search-results option[value='" + jQuery('#search-box').val() + "']").attr('data-iso');

        initialize_city(user_country);
        initialize_region(user_country);

    });
});

function initialize_city(id) {
    var our_country = id;
    var input = document.getElementById('searchCityField');
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: our_country}
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}

function initialize_region(id) {
    var our_country = id;
    var input = document.getElementById('searchRegionField');
    var options = {
        types: ['(regions)'],
        componentRestrictions: {country: our_country}
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}