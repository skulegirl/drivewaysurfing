/******
 * create cookie to remember our center and zoom level when we 
 * navigate back to the map page
 * */

Drupal.behaviors.gmapsavepos = function(context) {

  if (typeof Drupal.gmap != 'undefined') {

   Drupal.gmap.addHandler('gmap', function(elem) {
    var obj = this;
   
    obj.bind("init", function () {
      var map = obj.map;
      window.setTimeout(function() {
	if (location.pathname != "/all-boondocking-locations")
	{
	   return;
        }
	var cookiename = 'gmapsavedpos_' + location.pathname;      
        var pos = $.cookie(cookiename);
       
        if (pos != null) {
          var posJSON = JSON.parse(pos);
          map.setCenter(new google.maps.LatLng(posJSON.latitude, posJSON.longitude));
	  map.setZoom(posJSON.zoom);
        }
       
        $('body').addClass('gmapsavedpos');
      }, 1000);
     
    });
   
    obj.bind('move', function() {
      if ($('body').hasClass('gmapsavedpos')) {
        var map = obj.map;
        var centerJSON = {
          'latitude': obj.vars.latitude,
          'longitude': obj.vars.longitude,
          'zoom': obj.vars.zoom
        };
	var cookiename = 'gmapsavedpos_' + location.pathname;      
        $.cookie(cookiename, JSON.stringify(centerJSON), {expire: 1});
      }
    });
   });
  }
};
