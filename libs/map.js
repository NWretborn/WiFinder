

var firstSet = false;
	
var customIcons = {
    No: {
      icon: '/img/logo_green50px.png'
    },
    Yes: {
      icon: '/img/logo_blue50px.png'
    }
  };

function load() {
     
	var map = new google.maps.Map(document.getElementById("map"), {
	center: new google.maps.LatLng(65.579475, 22.153313),
	zoom: 12,
	styles:
      [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8ec3b9"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1a3646"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4b6878"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#64779e"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4b6878"
      }
    ]
  },
  {
    "featureType": "landscape.man_made",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#334e87"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#283d6a"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#6f9ba5"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3C7680"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#304a7d"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#98a5be"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2c6675"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#255763"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#b0d5ce"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#98a5be"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#283d6a"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3a4762"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#0e1626"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#4e6d70"
      }
    ]
  }
]
});
	
	
	
    
	function GeolocationControl(controlDiv, map) {

    // Set CSS for the control button
    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#10454e';
    controlUI.style.borderStyle = 'solid';
    controlUI.style.borderWidth = '1px';
    controlUI.style.borderColor = '#29afc4';
    controlUI.style.backgroundImage = "url(/img/gps_icon.png)";
    controlUI.style.height = '26px';
    controlUI.style.width = '26px';
    controlUI.style.cursor = 'pointer';
	controlUI.style.marginTop = '50%';
    controlDiv.appendChild(controlUI);



  

    // Setup the click event listeners to geolocate user
    google.maps.event.addDomListener(controlUI, 'click', geolocate);
}
	
	function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

function geolocate() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function (position) {

	var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

	// Set marker position and visibility
	marker.setPosition(pos);
	marker.setVisible(true);	
		
	// Center map
	map.setCenter(pos);
        });
    }	
}	
	
	
	// Create the DIV to hold the control and call the constructor passing in this DIV
	var geolocationDiv = document.createElement('div');
	var geolocationControl = new GeolocationControl(geolocationDiv, map);
	
	map.controls[google.maps.ControlPosition.TOP_CENTER].push(geolocationDiv);
	
	// Create the search box and link it to the UI element.
	var input = document.getElementById('pac-input');
	var searchBox = new google.maps.places.SearchBox(input);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	
	// Create an invisible marker to be used later
    	marker = new google.maps.Marker({
        position: new google.maps.LatLng(0, 0),
        animation: google.maps.Animation.DROP,
	icon: '/img/user_icon.png',
        visible: false,
        map: map
	});
	// Bias the SearchBox results towards current map's viewport.
	map.addListener('bounds_changed', function() {
		searchBox.setBounds(map.getBounds());
	});

	var infoWindow = new google.maps.InfoWindow;

           
    // Change this depending on the name of your PHP file
    downloadUrl("phpsqlajax_genxml3.php", function(data) {
    
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName("marker");
	    	var merkers = [];
	    	var bounds = new google.maps.LatLngBounds();
		for (var i = 0; i < markers.length; i++) {
			var user = markers[i].getAttribute("user");	
			var name = markers[i].getAttribute("name");
			var rating = markers[i].getAttribute("rating");
			var address = markers[i].getAttribute("address");
			var type = markers[i].getAttribute("type");
			var quality = markers[i].getAttribute("quality");
			var picurl = markers[i].getAttribute("picurl");
			var point = new google.maps.LatLng(
            			parseFloat(markers[i].getAttribute("lat")),
            			parseFloat(markers[i].getAttribute("lng"))
			);
			//Popup window variable
			var html = name + "," + address + "," + quality + "," + user + "," + type + "," + picurl;
			var icon = customIcons[type] || {};
			var marker = new google.maps.Marker({
			map: map,
			position: point, location,
			icon: icon.icon
		});
	

      

	
			
			
	//THIS CODE IS TO BE IMPLEMENTED WHEN YOU WANT TO ADD A NETWORK WITH ACCOUNT PRIV
			
	//Eventlistener for adding marker to map on click
	google.maps.event.addListener(map, 'click', function(event) {
		//if SESSION
		
   		placeMarker(event.latLng);
		
	});

		
			
	function placeMarker(location) {
		
		if ( firstSet ) {
    			marker.setPosition(location);
 		 } 
		else {
    			marker = new google.maps.Marker({
      			position: location,
			animation: google.maps.Animation.DROP,
     			map: map,
			icon: '/img/logo_gray50px.png'
		});
			firstSet = true;
  		}
		var locArr = String(location);
		var lat = String(locArr.slice(1,12));
		var lon = String(locArr.slice(19,31));
		if (lon[0] == "," || lon[0] == " ") {
			if (lon[0] == " ") {
				var lon = String(locArr.slice(20,32));
			}
			else {
			var lon = String(locArr.slice(21,33));
			}
		}
		else if(lon[1] == "," || lon[1] == " ") {
			if (lon[1] == " ") {
				var lon = String(locArr.slice(22,34));
			}
			else {
			var lon = String(locArr.slice(23,35));
			}
		}
		//document.getElementById("lat").innerHTML=lat;
		//document.getElementById("lon").innerHTML=lon;
		document.getElementById('latval').value = lat;
		document.getElementById('lonval').value = lon;
	}
			
	
	
		
			
			
			
	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener('places_changed', function() {
		var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
		};
	// For each place, get the icon, name and location.
	var bounds = new google.maps.LatLngBounds();
          
           
	places.forEach(function(place) {
	if (!place.geometry) {
		console.log("Returned place contains no geometry");
		return;
	}
	if (place.geometry.viewport) {
		// Only geocodes have viewport.
		bounds.union(place.geometry.viewport);
        } 
	else {
        bounds.extend(place.geometry.location);
		}
	var icon = {
		url: place.icon,
		size: new google.maps.Size(71, 71),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(17, 34),
		scaledSize: new google.maps.Size(25, 25)
	} 
})
	map.fitBounds(bounds);
});
          
          
	merkers.push(marker);
        bounds.extend(point);
	bindInfoWindow(marker, map, infoWindow, html);
}
    // Add a marker clusterer to manage the markers.
	var markerCluster = new MarkerClusterer(map, merkers,
	{imagePath: '/img/c'});
    });

	geolocate();

}

	//Lyssnar på markerclick, lägg hide button här i
	function bindInfoWindow(marker, map, infoWindow, html) {
		google.maps.event.addListener(marker, 'click', function() {
		var htmldat = html.split(",");
		document.getElementById("htmlname").innerHTML=String("Name: " + htmldat[0]); 
		document.getElementById("htmladdress").innerHTML=String("Location: " + htmldat[1]);
		document.getElementById("htmlquality").innerHTML=String("Rating: " + htmldat[2]);
		document.getElementById("htmluser").innerHTML=String("Submitted by: " + htmldat[3]); 
		document.getElementById("htmltype").innerHTML=String("Customer only: " + htmldat[4]);
		document.getElementById("htmlpicurl").src=String("/uploaded_files/"+htmldat[5]);
		document.getElementById("htmluserdel").value=String(htmldat[3]);
		document.getElementById("htmlpicurldel").value=String(htmldat[5]);
		infoWindow.setContent(htmldat[0]);
		infoWindow.open(map, marker);
		action(htmldat[3]);
	});
}

	function downloadUrl(url, callback) {
		var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
		request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

function doNothing() {}
