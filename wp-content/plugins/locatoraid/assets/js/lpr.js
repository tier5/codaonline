function ntsDistanceFrom(loc1, loc2)
{
	var lat = [loc1.lat(), loc2.lat()]
	var lng = [loc1.lng(), loc2.lng()]
	var R = 6378137;
	var dLat = (lat[1]-lat[0]) * Math.PI / 180;
	var dLng = (lng[1]-lng[0]) * Math.PI / 180;
	var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
	Math.cos(lat[0] * Math.PI / 180 ) * Math.cos(lat[1] * Math.PI / 180 ) *
	Math.sin(dLng/2) * Math.sin(dLng/2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	var d = R * c;
	return Math.round(d);
}

jQuery(document).on( 'click', 'a.hc-confirm', function(event)
{
	return window.confirm("Are you sure?");
});

var lpr_current_location_set = 0;
var lpr_markers = [];
var lpr_data = [];

var lpr_on_marker_click = function(event)
{
	var marker = this;
	lpr_infowindow.setContent( marker.content );
	lpr_infowindow.setPosition( marker.getPosition() );
	lpr_infowindow.open( lpr_map, marker );

	// highlight the item in the list
	var location_in_list = jQuery('#lpr-locations').find('[data-id="' + marker.lpr_location_id + '"]');
	if( location_in_list.length ){
		var this_holder = jQuery('#lpr-locations');
		var this_thumbnail = location_in_list.parent();
		this_holder.find('.thumbnail').removeClass('alert-info');
		this_thumbnail.addClass('alert-info');
		this_holder.scrollTop( this_holder.scrollTop() + location_in_list.position().top - this_holder.height()/2 + location_in_list.height()/2 );
	}
};

jQuery(document).on( 'click', '#lpr-next-within', function(event) {
	event.preventDefault();
	event.stopPropagation();
	var next_within = jQuery(this).data('within');

	jQuery('#lpr-search-within').find('option[value="' + next_within + '"]').attr('selected', 'selected');

	if( lpr_current_location_set )
	{
		lpr_with_position( lpr_current_location_set );
	}
	else
	{
		lpr_search_form_submit( jQuery('#lpr-search-form') );
		// jQuery('#lpr-search-form').submit();
	}
	return false;
});

function lpr_with_position( position )
{
	var within = jQuery('#lpr-search-form').find('[name=within]').val();
	var search2 = jQuery('#lpr-search-form').find('[name=search2]').val();
	if( jQuery('#lpr-results').is(':hidden') )
	{
		jQuery('#lpr-results').show();
		lpr_map = new google.maps.Map( 
			document.getElementById("lpr-map"),
			{
				zoom:15,
				mapTypeId:google.maps.MapTypeId.ROADMAP,
				scrollwheel: lpr_vars.map_scrollwheel
			}
		);
	}

	var pos = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );

	var target_div = jQuery( '#lpr-locations' );
	if( target_div )
		target_div.html( '' );

//		jQuery( '#lpr-autodetect' ).parent().toggle();
//		jQuery( '#lpr-search-address' ).removeClass( 'hc-loading' );
//		jQuery( '#lpr-search-address' ).toggle();
//		jQuery( '#lpr-current-location' ).toggle();
//		jQuery( '#lpr-search-button' ).toggle();

	lpr_front_get_results_by_coord( 
		pos,
		search2,
		'_autodetect_',
		true,
		within
		);
}

jQuery(document).on( 'click', '#lpr-search-button', function(event) {
	lpr_search_form_submit( jQuery('#lpr-search-form') );
	// jQuery('#lpr-search-form').submit();
	return false;
});

jQuery(document).on( 'keydown', '#lpr-search-address', function(event) {
	if( event.which == 13 )
	{
		event.preventDefault();
		event.stopPropagation();
		lpr_search_form_submit( jQuery('#lpr-search-form') );
		return false;
	}
});

jQuery(document).on( 'change', '#lpr-search-form select', function(event) {
	if( lpr_current_location_set )
	{
		lpr_with_position( lpr_current_location_set );
	}
	else
	{
		lpr_search_form_submit( jQuery('#lpr-search-form') );
		// jQuery('#lpr-search-form').submit();
	}
	return false;
});

jQuery(document).on( 'click', '#lpr-autodetect', function(event) {
	if( navigator.geolocation )
	{
		var geo_timeout = 5000;

		jQuery( '#lpr-search-address' ).addClass( 'hc-loading' );
		setTimeout( function(){
			jQuery( '#lpr-search-address' ).removeClass( 'hc-loading' );
			}, geo_timeout );

		var search2 = jQuery('#lpr-search-form').find('[name=search2]').val();

		navigator.geolocation.getCurrentPosition(
			function(position)
			{
				jQuery( '#lpr-search-address' ).removeClass( 'hc-loading' );

				jQuery( '#lpr-autodetect' ).parent().toggle();
//				jQuery( '#lpr-search-address' ).parent().toggle();
				jQuery( '#lpr-search-address' ).toggle();
				jQuery( '#lpr-current-location' ).toggle();
				jQuery( '#lpr-search-button' ).toggle();
				jQuery( '#lpr-skip-current-location' ).parent().toggle();

				lpr_current_location_set = position;
				lpr_with_position( lpr_current_location_set );
			},
			function( error )
			{
				var err_msg = 'Sorry your device could not get your location';
				switch( error.code )
				{
					case error.PERMISSION_DENIED:
						err_msg = "User denied the request for Geolocation.";
//						err_msg = "";
						break;
					case error.POSITION_UNAVAILABLE:
						err_msg = "Location information is unavailable.";
						break;
					case error.TIMEOUT:
//						err_msg = "The request to get user location timed out.";
						err_msg = "";
						break;
					case error.UNKNOWN_ERROR:
						err_msg = "An unknown error occurred.";
						break;
				}
				jQuery( '#lpr-search-address' ).removeClass( 'hc-loading' );
				if( err_msg )
				{
					alert( err_msg );
				}
			},
			{
//				enableHighAccuracy: true, 
//				maximumAge        : 30000, 
				enableHighAccuracy	:false,
				timeout				: geo_timeout,
			}
			);
	}
	else
	{
		alert( 'geolocation not supported' );
	}
	return false;
});

jQuery(document).on( 'click', '#lpr-skip-current-location', function(event) {
	// jQuery( '#lpr-search-address' ).parent().toggle();
	jQuery( '#lpr-search-address' ).toggle();
	jQuery( '#lpr-current-location' ).toggle();
	jQuery( '#lpr-autodetect' ).parent().toggle();
	jQuery( '#lpr-search-button' ).toggle();
	jQuery( '#lpr-skip-current-location' ).parent().toggle();
	lpr_current_location_set = 0;
	return false;
});

jQuery(document).on( 'click', '.lpr-directions', function(event) {
	event.preventDefault();
	event.stopPropagation();

	if( ! lpr_loc )
	{
		alert( 'Please search for an address or zip code first' );
		return false;
	}

	var my_parent = jQuery(this).closest('.lpr-location');
	if( ! my_parent ){
		return false;
	}

	var clicked_in = 'sidebar';
	var this_thumbnail = my_parent.parent('.thumbnail');
	if( this_thumbnail && this_thumbnail.html() )
	{
		jQuery('#lpr-locations .thumbnail').removeClass('alert-info');
		this_thumbnail.addClass('alert-info');
	}
	else
	{
		var clicked_in = 'own';
	}

	var end = new google.maps.LatLng( my_parent.data('lat'), my_parent.data('lng') );
	var request = {
		origin: lpr_loc,
		destination: end,
		travelMode: google.maps.TravelMode.DRIVING
		};

	lpr_directions_service.route(request, function(result, status)
	{
		if (status == google.maps.DirectionsStatus.OK)
		{
			var directions_panel = jQuery("#lpr-directions-panel");

			lpr_directions_display.setMap( null );
			lpr_directions_display.setMap( lpr_map );
			if( directions_panel )
			{
				directions_panel.show();
				lpr_directions_display.setPanel( document.getElementById("lpr-directions-panel") );
			}
			lpr_directions_display.setDirections(result);

			if( clicked_in == 'sidebar' )
				directions_panel.insertAfter(this_thumbnail);
			else
			{
				if( jQuery('#lpr-locations') )
				{
					jQuery('#lpr-locations .thumbnail').removeClass('alert-info');
					directions_panel.addClass('alert-info');
					jQuery('#lpr-locations').prepend( directions_panel );
					jQuery('#lpr-locations').scrollTop(0);
				}
			}
				
		}
	});
	return false;
});

jQuery(document).on( 'click', '#lpr-locations .lpr-location', function(event)
{
	var this_thumbnail = jQuery(this).parent();

	// find this location
	this_content = "";
 	for( var ii = 0; ii < lpr_data.length; ii++ ){
		if( ! lpr_data[ii].id )
			continue;
		if( lpr_data[ii].id == jQuery(this).data('id') ){
			this_content = lpr_data[ii].display_map;
			break;
		}
	}

	if( ! this_content ){
		this_content = this_thumbnail.html()
	}
	else {
		this_content = '<div class="lpr-location" data-id="' + jQuery(this).data('id') + '" data-lat="' + jQuery(this).data('lat') + '" data-lng="' + jQuery(this).data('lng') + '">' + this_content + '</div>';
	}

	// clear directions	
	var directions_panel = jQuery("#lpr-directions-panel");
	directions_panel.hide();
	lpr_directions_display.setMap( null );

	// adjust map so it shows both source and target location
	var location_position = new google.maps.LatLng( jQuery(this).data('lat'), jQuery(this).data('lng') );
	if( lpr_loc ){
		lpr_map.setCenter( lpr_loc );
	}
	else {
		lpr_map.setCenter( location_position );
	}

	var z = 15;
	for ( var zz = z; zz > 1; zz-- ){
		lpr_map.setZoom( zz );
		if( lpr_map.getBounds().contains( location_position ) )
			break;
	}

	jQuery('#lpr-locations .thumbnail').removeClass('alert-info');
	this_thumbnail.addClass('alert-info');

	// lpr_infowindow.setContent( this_thumbnail.html() );
	lpr_infowindow.setContent( this_content );

	lpr_infowindow.setPosition( location_position );
	lpr_infowindow.open( lpr_map );
});

function lpr_front_process_search( address, search2, allow_empty, within )
{
	allow_empty = (typeof allow_empty === "undefined") ? false : allow_empty;
	if( (! allow_empty) && (address.length < 1) && (search2.length < 1) ){
	}
	else {
		lpr_front_get_results( address, search2, allow_empty, within );
	}
	return false;
}

function lpr_show_on_map( loc, target_div, data )
{
// clear previous markers
	for ( var i = 0; i < lpr_markers.length; i++)
	{
		lpr_markers[i].setMap( null );
	}
	lpr_markers = [];

	var listing_html = '';

// nothing ?
	if( data.error )
	{
		var listing_html = '';
		listing_html += '<div class="thumbnail alert-error">' + data.error + '</div>';
		if( target_div )
			target_div.append( listing_html );
	}
	else
	{
		var calc_distance = false;
		if( ! loc )
		{
			calc_distance = true;
			if( data.length > 0 )
			{
/*
				for( var ii = 0; ii < data.length; ii++ )
				{
					if( ! data[ii].id ) // group header
						continue;

					loc = new google.maps.LatLng( data[ii].lat, data[ii].lng );
					lpr_map.setCenter( loc );
					break;
				}
*/
				var bound = new google.maps.LatLngBounds();
				for( var ii = 0; ii < data.length; ii++ )
				{
					if( ! data[ii].id ) // group header
						continue;
					// bound.extend( new google.maps.LatLng(data[ii].lat, data[ii].lng) );

					padded_lat = parseFloat( data[ii].lat );
					padded_lng = parseFloat( data[ii].lng );
					padded_lat += (padded_lat > 0) ? 0.02 : -0.02;
					padded_lng += (padded_lng > 0) ? 0.02 : -0.02;

					bound.extend( new google.maps.LatLng(padded_lat, padded_lng) );
				}
				loc = bound.getCenter();
			}
		}

	/* here we display locations */
		for( var ii = 0; ii < data.length; ii++ )
		{
			if( ! data[ii].id ) // group header
			{
				var wrap_by = data[ii].header ? 'h' + data[ii].header : 'h4';
				listing_html += '<' + wrap_by + '>' + data[ii].display + '</' + wrap_by + '>';
			}
			else
			{
				var div_class = 'thumbnail';
				if( data[ii].priority > 0 )
					div_class += ' thumbnail-success';
				var wrapper = '<div class="lpr-location" data-id="' + data[ii].id + '" data-lat="' + data[ii].lat + '"' + 'data-lng="' + data[ii].lng + '">';
				listing_html += '<div class="' + div_class + '">' + wrapper + data[ii].display + '</div></div>';
			}
		}
		listing_html += '<div id="lpr-directions-panel" class="thumbnail" style="display: none;"></div>'
		if( target_div )
			target_div.append( listing_html );

	// show on map
		var max_distance = 0;
		var max_distance_id = -1;
		for( var ii = 0; ii < data.length; ii++ )
		{
			if( ! data[ii].id ) // group header
				continue;

			var wrapper = '<div class="lpr-location" data-id="' + data[ii].id + '" data-lat="' + data[ii].lat + '"' + 'data-lng="' + data[ii].lng + '">';
			// var content = wrapper + data[ii].display + '</div>';
			var content = wrapper + data[ii].display_map + '</div>';
			var location_position = new google.maps.LatLng( data[ii].lat, data[ii].lng );
			var location_marker = new google.maps.Marker( {
//				icon: "//localhost/_avatars/1.jpg",
				map: lpr_map,
				position: location_position,
				title: data[ii].name,
				draggable: false,
				visible: true,
				animation: google.maps.Animation.DROP,
				content: content,
				lpr_location_id: data[ii].id,
				});

			var this_distance = ( calc_distance ) ? ntsDistanceFrom(location_position, loc) : data[ii].distance;
			this_distance = parseFloat( this_distance );
			if( this_distance > max_distance )
			{
				max_distance = this_distance;
				max_distance_id = ii;
			}

//			google.maps.event.addListener(marker, 'click', function() {
//				infobox.open(map, this);
//				map.panTo(loc);
//				});

			google.maps.event.addListener( location_marker, 'click', lpr_on_marker_click );
			lpr_markers.push( location_marker );
		}

	// zoom
		lpr_map.setCenter( loc );
		if( (typeof lpr_default_map_zoom !== 'undefined') && (lpr_default_map_zoom != 0) ){
			lpr_map.setZoom( lpr_default_map_zoom );
			lpr_default_map_zoom = 0;
			}
		else {
			if( max_distance_id > -1 ){
				var location_position = new google.maps.LatLng( data[max_distance_id].lat, data[max_distance_id].lng );

				var z = lpr_map.getZoom();
				z = 15;
				for ( var zz = z; zz > 1; zz-- ){
					lpr_map.setZoom( zz );
					if( lpr_map.getBounds().contains( location_position ) ){
						// lpr_map.setZoom( zz - 1 );
						break;
					}
				}
			}
		}
	}
}

function lpr_set_cookie( cname, cvalue, exdays )
{
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}

function lpr_delete_cookie( cname )
{
	document.cookie = cname + "=; Path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

function lpr_get_cookie( cname )
{
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for( var i=0; i < ca.length; i++ ) 
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
	}
	return "";
}

var lpr_search_working = 0;

function lpr_front_pull_results( loc, search2, address, allow_empty, within )
{
	if( lpr_search_working ){
		return false;
	}

	allow_empty = (typeof allow_empty === "undefined") ? false : allow_empty;
	var target_div = jQuery( '#lpr-locations' );
	var my_search2 = search2.length ? search2 : '-';
	if( loc )
	{
		var json_url = [ url_prefix, loc.lat(), loc.lng(), encodeURIComponent(my_search2), encodeURIComponent(address), lpr_log_it ].join('/');
		var json_url = [ url_prefix, loc.lat(), loc.lng(), lpr_log_it ].join('/');
	}
	else
	{
		var json_url = [ url_prefix, '_all_', '_all_', encodeURIComponent(my_search2), encodeURIComponent(address), lpr_log_it ].join('/');
		var json_url = [ url_prefix, '_all_', '_all_', lpr_log_it ].join('/');
	}

	if( ! lpr_log_it )
		lpr_log_it = 1;
	if( target_div )
		target_div.addClass( 'hc-loading' );

	var csrfToken2 = jQuery('#lpr-search-form').find('[name=hc_csrf_token]').val();
	var csrfToken = lpr_get_cookie( 'hc_csrf_cookie' );

//	alert( "hidden = " + csrfToken2 );
//	alert( "cookie = " + csrfToken );

	if( 
		(! csrfToken)
//		||
//		(csrfToken != csrfToken2)
		)
	{
		var my_rand = Math.floor( (Math.random() * 1000000) + 1 );
		var init_url = [ url_prefix, 'init', my_rand ].join('/');

		jQuery.ajax({
			type: "GET",
			url: init_url,
			dataType: "text",
			success: function(data, textStatus){
				var csrfToken = data;
				lpr_set_cookie( 'hc_csrf_cookie', csrfToken, 1 );

//				alert( "3 = " + csrfToken );

				var thisData = {
					hc_csrf_token: csrfToken,
					search2: my_search2,
					address: address,
					within: within
					};

				jQuery.ajax({
					type: "POST",
					url: json_url,
					dataType: "json",
					data: thisData,
					success: function(data, textStatus){
						lpr_data = data;

						if( target_div )
							target_div.removeClass( 'hc-loading' );

						if( typeof lpr_vars.show_matched_locations !== 'undefined' ){
							if( lpr_vars.show_matched_locations !== '' ){
								var matched_count = 0;
								for( var ii = 0; ii < data.length; ii++ ){
									if( ! data[ii].id ) // group header
										continue;
									matched_count++;
								}
								if( matched_count > 0 ){
									target_div.append( lpr_vars.show_matched_locations + ': ' + matched_count + '<br>' );
								}
							}
						}

						if( typeof lpr_vars.show_print_link !== 'undefined' ){
							if( lpr_vars.show_print_link.length > 0 ){
								var print_within = within ? within : 0;
								var print_url = [ json_url, 1, print_within, encodeURIComponent(my_search2), encodeURIComponent(address) ].join('/');
								target_div.append( '<a target="_blank" href="' + print_url + '">' + lpr_vars.show_print_link + '</a><br>' );
							}
						}

						lpr_show_on_map( loc, target_div, data );
						lpr_offset += lpr_limit;
						}
					})
					.fail( function(data){
						target_div.removeClass( 'hc-loading' );
						// alert( 'Error parsing JSON from ' + json_url + "\nResponse:\n" + data.responseText  );
						})
				}
			});
	}
	else
	{
//		alert( "4 = " + csrfToken );

// alert( "Posting to " + json_url );
		lpr_search_working = 1;

		var thisData = {
			hc_csrf_token: csrfToken,
			search2: my_search2,
			address: address,
			within: within
			};

		jQuery.ajax({
			type: "POST",
			url: json_url,
			dataType: "json",
			data: thisData,
			success: function(data, textStatus){
				lpr_data = data;
				lpr_search_working = 0;
				if( target_div )
					target_div.removeClass( 'hc-loading' );

				if( typeof lpr_vars.show_matched_locations !== 'undefined' ){
					if( lpr_vars.show_matched_locations !== '' ){
						var matched_count = 0;
						for( var ii = 0; ii < data.length; ii++ ){
							if( ! data[ii].id ) // group header
								continue;
							matched_count++;
						}
						if( matched_count > 0 ){
							target_div.append( lpr_vars.show_matched_locations + ': ' + matched_count + '<br>' );
						}
					}
				}

				if( typeof lpr_vars.show_print_link !== 'undefined' ){
					if( lpr_vars.show_print_link.length > 0 ){
						var print_within = within ? within : 0;
						var print_url = [ json_url, 1, print_within, encodeURIComponent(my_search2), encodeURIComponent(address) ].join('/');
						target_div.append( '<a target="_blank" href="' + print_url + '">' + lpr_vars.show_print_link + '</a><br>' );
					}
				}

				lpr_show_on_map( loc, target_div, data );
				lpr_offset += lpr_limit;
				}
			})
			.fail( function(data){
				lpr_search_working = 0;
				target_div.removeClass( 'hc-loading' );
				// alert( 'Error parsing JSON from ' + json_url + "\nResponse:\n" + data.responseText  );
				})
	}

	return false;
}

function lpr_front_get_results_by_coord( loc, search2, address, allow_empty, within )
{
	allow_empty = (typeof allow_empty === "undefined") ? false : allow_empty;
	lpr_loc = loc;
	lpr_map.setCenter( lpr_loc );

	if( lpr_start_marker )
	{
		lpr_start_marker.setMap( null );
		lpr_start_marker = null;
	}

	lpr_start_marker = new google.maps.Marker( {
		map: lpr_map,
		position: lpr_loc,
		draggable: false,
		visible:true,
		icon: "//maps.google.com/mapfiles/arrow.png"
		});

// get matching locations
	lpr_offset = 0;
	lpr_front_pull_results( lpr_loc, search2, address, allow_empty, within );
	return false;
}

function lpr_front_get_results( address, search2, allow_empty, within )
{
	allow_empty = (typeof allow_empty === "undefined") ? false : allow_empty;
	if( address.length < 1 )
	{
		lpr_front_pull_results( null, search2, address, allow_empty, within );
	}
	else
	{
		try {
			lpr_geocoder.geocode(
				{ 'address': address },
				function( results, status )
				{
					switch( status )
					{
						case google.maps.GeocoderStatus.OVER_QUERY_LIMIT :
							alert( 'Daily limit reached, please try tomorrow' );
							break;

						case google.maps.GeocoderStatus.OK :
							lpr_front_get_results_by_coord( results[0].geometry.location, search2, address, allow_empty, within )
							break;

						case google.maps.GeocoderStatus.ZERO_RESULTS :
							alert( "Can't locate this address:" + address );
							break;

						case google.maps.GeocoderStatus.REQUEST_DENIED :
							alert( 'Geocode error: request denied' );
							break;

						case google.maps.GeocoderStatus.INVALID_REQUEST :
							alert( 'Geocode error: invalid request' );
							break;

						default :
							alert( 'Geocode error:' + status );
							break;
					}
				}
			);
		}
		catch(err) {
			alert( 'error occured: ' + err.message );
		}
	}
}

/* admin panel functions */
function lpr_geocode_show_result( url_prefix, data, loc, error, items_left )
{
    if( typeof lpr_geocode_show_result.counter == 'undefined' ){
        lpr_geocode_show_result.counter = 0;
		}
    lpr_geocode_show_result.counter++;

	var show_html;
	if( error.length > 0 )
	{
		show_html = '<div class="alert alert-error">';
		show_html += '<a href="' + url_prefix + '/edit/' + data.id + '">' + data.address + '</a>';
		show_html += '<br>GOOGLE GEOCODING ERROR: ' + error;
		show_html += '</div>';
	}
	else
	{
		items_left = items_left - 1;
		show_html = '<div class="alert alert-success">' + data.address + '<br>' + loc.lat() + ', ' + loc.lng() + '</div>';
	}
	jQuery('#lpr-locations-result').html( show_html );
	lpr_geocode_show_status( lpr_geocode_show_result.counter, items_left );
}

function lpr_geocode_show_status( count, items_left )
{
	if( count > 0 )
	{
		if( items_left > 0 )
		{
			var status_html = 'Processed: ' + count + ', Left: ' + items_left;
		}
		else
		{
			var status_html = '<div class="alert alert-success">' + 'Processed ' + lpr_geocode_show_result.counter + ' locations' + '</div>';
			jQuery('#lpr-locations-result').html( '' );
		}
	}
	else
	{
		var status_html = '<div class="alert alert-success">' + 'All locations already geocoded' + '</div>';
	}
	jQuery('#lpr-locations-result-status').html( status_html );
}

function lpr_next_location( url_prefix, loc_id, map )
{
    if( typeof lpr_next_location.attempts == 'undefined' ){
        lpr_next_location.attempts = 0;
		}

	// gets next location that needs geocoding
	var json_url =  [ url_prefix, 'geocode-get' ].join('/');

	jQuery.getJSON(
		json_url,
		function( data )
		{
			if( data.id > 0 )
			{
			// get coordinates for location
				lpr_geocoder.geocode(
					{ 'address': data.address },
					function( results, status )
					{
						switch( status )
						{
							case google.maps.GeocoderStatus.OVER_QUERY_LIMIT :
								if( lpr_next_location.attempts < 3 )
								{
								// wait for 2 sec then try again
									lpr_next_location.attempts++;
									setTimeout( function(){lpr_next_location(url_prefix, loc_id, map)}, 2000);
								}
								else
								{
								// daily limit reached
									lpr_geocode_show_result( url_prefix, data, null, 'Daily limit reached, please try tomorrow', data.left );
								}
								break;

							case google.maps.GeocoderStatus.ZERO_RESULTS:
								var save_url = [ url_prefix, 'geocode-save', data.id, -1, -1 ].join('/');
								jQuery.ajax( save_url )
								.done( function()
									{
										lpr_geocode_show_result( url_prefix, data, null, 'Address not found', data.left );

										if( ! loc_id )
										{
											if( data.left > 1 )
											{
												// go to next one in 0.5 sec
												setTimeout( function(){lpr_next_location(url_prefix, loc_id, map)}, 500);
											}
										}
										else
										{
											alert( 'done' );
										}
									}
								);
								break;

							case google.maps.GeocoderStatus.OK :
								lpr_next_location.attempts = 0;
								var loc = results[0].geometry.location;
							// save coordinates
								var save_url = [ url_prefix, 'geocode-save', data.id, loc.lat(), loc.lng() ].join('/');
								jQuery.ajax( save_url )
								.done( function()
									{
										lpr_geocode_show_result( url_prefix, data, loc, '', data.left );

										if( map )
										{
											map.setCenter( loc );
											var marker = new google.maps.Marker({
												map: map,
												position: loc
												}
											);
										}

										if( ! loc_id )
										{
											if( data.left > 1 )
											{
												// go to next one in 0.5 sec
												setTimeout( function(){lpr_next_location(url_prefix, loc_id, map)}, 500);
											}
										}
										else
										{
											alert( 'done' );
										}
									}
								);
								break;

							default :
								lpr_geocode_show_result( url_prefix, data, null, status, data.left );
								break;
						}
					}
				);
			}
			else
			{
				lpr_geocode_show_status( 0, 0 );
			}
		}
	)
	.error( function(data)
		{
			// alert( 'Error parsing JSON from ' + json_url );
			// alert(JSON.stringify(data));
		}
	);
}

function lpr_search_form_submit( search_form )
{
	var address = search_form.find('[name=search]').val();
	var country = search_form.find('[name=country]').val();
	if( country )
	{
		if( address )
			address = address + ' ' + country;
		else
			address = country;
	}

	if( lpr_vars.conf_append_search.length > 0 )
	{
		// check if it already ends with append
		if( address.substr(address.length - lpr_vars.conf_append_search.length).toLowerCase() != lpr_vars.conf_append_search.toLowerCase() )
		{
			address = address + ' ' + lpr_vars.conf_append_search;
		}
	}

	var search2 = search_form.find('[name=search2]').val();
	var within = search_form.find('[name=within]').val();

	if( jQuery('#lpr-results').is(':hidden') )
	{
		if( address.length || (search2.length && (search2 != ' ')) )
		{
			jQuery('#lpr-results').show();

			lpr_map = new google.maps.Map( 
				document.getElementById("lpr-map"),
				{
					zoom:15,
					mapTypeId:google.maps.MapTypeId.ROADMAP,
					scrollwheel: lpr_vars.map_scrollwheel
				}
			);
		}
	}

	allow_empty = (typeof allow_empty === "undefined") ? false : allow_empty;
	if( (! allow_empty) && (address.length < 1) && (search2.length < 1) )
		return false;

	var target_div = jQuery( '#lpr-locations' );
	if( target_div )
		target_div.html( '' );

	lpr_directions_display.setMap( null );
	lpr_front_process_search( address, search2, lpr_allow_empty, within );

	search_form.trigger( 'search', [address, search2, within] );
	return false;
}