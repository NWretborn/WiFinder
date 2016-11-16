<!DOCTYPE html>
<html>
<style>
	body{
		background-color: black;
		/* background-image: url("index_background.png"); */
		background-size:cover;
	}
	.logo{
		position: fixed;
		height:15vh;
		left:8%;
		bottom:8vw;
		transform: translate(-50%, 50%);
	}
</style>
<script type="text/javascript">
	function changePic(element, imageName) {
    	element.setAttribute('src', imageName);
	}
	
	function larger(element){
		var style = window.getComputedStyle(element),
		h = parseFloat(style.height),
		vH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0); // MOBILE SCALING!!!
		h = (h*1.2)/vH*100;
		element.style.height = h + 'vh';
	}
	
	
	function smaller(element){
		var style = window.getComputedStyle(element),
		h = parseFloat(style.height),
		vH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0); // MOBILE SCALING!!!
		h = (h/1.2)/vH*100;
		element.style.height = h + 'vh';
	}
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJR14TQYMP-yBtsSpULmOe0hM7bHPWasQ"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(47.6145, -122.3418),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("phpsqlajax_genxml3.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
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

    //]]>

  </script>

  </head>

  <body onload="load()">
    <div id="map" style="width: 300px; height: 500px"></div>
    
	<!--<img src="logo_gray.png" class="logo" 
		onmouseover="changePic(this, 'logo_blue.png'); larger(this);" 
		onmouseout="changePic(this, 'logo_gray.png'); smaller(this);"
		onclick="location.href='index.php';"
>-->
  </body>

</html>
