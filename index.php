
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Using HTML5 Geolocation to show current location with Google Maps API by KnockChange</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="author" content="@toddmotto">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/demo.css" rel="stylesheet">
	</head>
	<body>
		<div class="header">
			<div class="logo">
				
			</div>
			<ul class="nav">
				<li class="nav-link">
				</li>
			</ul>
		</div>
		<?php echo'name' ?>
		<div id="google_canvas"></div>
		<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&key=AIzaSyBmnbwlpXfXURuO0UVzO66_pMn-McGB78A"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	    <script>
	    (function() {
	    
	    	if(!!navigator.geolocation) {
	    	
	    		var map;
	    	
		    	var mapOptions = {
		    		zoom: 15,
		    		mapTypeId: google.maps.MapTypeId.ROADMAP
		    	};
		    	
		    	map = new google.maps.Map(document.getElementById('google_canvas'), mapOptions);
	    		navigator.geolocation.getCurrentPosition(function(position) {
					city = "";
					pincode = '';
					
					geocoder = new google.maps.Geocoder();
		    		var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		    		
					geocoder.geocode({'latLng': latlng}, function(results, status) {
					
						if (status == google.maps.GeocoderStatus.OK) {
							//Check result 0
							var result = results[0];
							//look for locality tag and administrative_area_level_1
							
							for(var i = 0, len=result.address_components.length; i<len; i++) {
								var ac = result.address_components[i];
								if(ac.types.indexOf("locality") >= 0) city = ac.long_name;
								if(ac.types.indexOf("postal_code") >= 0) pincode = ac.long_name;
							}
							
							//only report if we got Good Stuff
							if(city != '' && pincode != '') {
								//$("#result").html("Hello to you out there in "+city+", "+pincode+"!");
								//alert(pincode);
							
								var infowindow = new google.maps.InfoWindow({
									map: map,
									position: latlng,
									content:
										'<h1>You Are Here!</h1>' +
										'Pincode: ' + pincode
								});
							}
		    		
							map.setCenter(latlng);
						} 
						//alert(state);
					});
					//alert(state);
		    		
		    		
	    		});
	    		
	    	} else {
	    		document.getElementById('google_canvas').innerHTML = 'No Geolocation Support.';
	    	}
	    	
	    })();
	    </script>
	
		<!-- Demo Analytics -->
		<script>
			var _gaq=[['_setAccount','UA-20440416-10'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src='//www.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)})(document,'script');
		</script>
		
		<!-- Demo Ads -->
		<script src="//www.toddmotto.com/ads/ads.js"></script>
		
	</body>
</html>
