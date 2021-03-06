 <?php

 session_start();
 		if(!isset( $_SESSION['username'] ) ){ #this triggers if session is not set
 			header("Location: /index.php");
 		}
 
 #For LOGOUT do a /api.php/logout as get, do index as redirect
 		
 // filename: upload.form.php
 
 // first let's set some variables
 
 // make a note of the current working directory relative to root.
 $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
 
 // make a note of the location of the upload handler
 $uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';
 
 // set a max file size for the html upload form
 $max_file_size = 2000000; // size in bytes
 
 // now echo the html page
 ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
 
 <!DOCTYPE html>
 <html>
 <!-- http://www.9lessons.info/2009/08/vote-with-jquery-ajax-and-php.html -->
 	
 	
 	
 	
 <head>
	<meta name="google-signin-client_id" content="608078643029-d690aqehavkkf285rkv30plgdjq3uh0u.apps.googleusercontent.com">
 	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
     	<meta charset="utf-8">
 	<title>WiFinder</title>
 	<link rel="stylesheet" type="text/css" href="libs/wifinder.css">
 	<link rel="stylesheet" type="text/css" href="libs/map.css">
 	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
 </head>
 	
 	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
 	<script src="libs/map.js"></script>
 	<script src="libs/std.js"></script>
 	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJR14TQYMP-yBtsSpULmOe0hM7bHPWasQ&libraries=places"async defer></script>
 	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
 	<script type="text/javascript">
 
  
 	
 // make json object from serialized array of html form
 
 // Get the element with id="defaultOpen" and click on it
 	$.fn.serializeObject = function() {
 		var o = {};
 		var a = this.serializeArray();
 		$.each(a, function() {
 			if (o[this.name]) {
 				if (!o[this.name].push) {
 					o[this.name] = [o[this.name]];
 				}
 				o[this.name].push(this.value || '');
 			} else {
 				o[this.name] = this.value || '';
 			}
 		});
 		return o;
 	};
 	// post the submission form to API via ajax in json format
 	function postForm(path, formID){
 		var picurl = document.getElementById("latval").value+"."+document.getElementById("lonval").value+".png";
    		document.getElementById("picurl").value = picurl;
 		var jsonOUT =$(formID).serializeObject();
 			var jsonSTR = JSON.stringify(jsonOUT);
			var name = jsonOUT['name'];
			var address = jsonOUT['address'];
		//Check name and address for special characters, alert accordingly
			if( name != '' && address != '' && picurl != '..png'){
 			$.ajax({
 				type: "POST",
 				url: "./"+path,
 				data: jsonSTR,
 				success: function(){alert("Network submitted!");},
 				dataType: "json",
 				contentType : "application/json"
 			});
 			
 			window.alert("Network added!");
 			window.location = "/map.php";	
			}
		
		else{
			alert("Click on the map to drop a marker and enter the name and address of the network before submitting");
		}
 	}	
 		
 	// post the submission form to API via ajax in json format
 	function deleteForm(path, formID){
    		document.getElementById("picurl").value = picurl;
 		document.getElementById("user").value = user;
		var currentuser = <?php echo json_encode($_SESSION['username'])?>;
		var jsonOUT =$(formID).serializeObject();
		var htmluserdel = jsonOUT['user'];
		if( currentuser == htmluserdel){
 		var jsonOUT =$(formID).serializeObject();
 			var jsonSTR = JSON.stringify(jsonOUT);
 			$.ajax({
 				type: "POST",
 				url: "./"+path,
 				data: jsonSTR,
 				success: function(){alert("Network Removed!");},
 				dataType: "json",
 				contentType : "application/json"
 			});
 			
 			window.alert("Network Removed");
 			window.location = "/index.php";
		}
 		else{
			alert("Please click on a network you have submitted before deleting");
		}
 		
 	}
		
		 function action(user) {
	 var currentuser = <?php echo json_encode($_SESSION['username'])?>;
		var htmluserdel = user;
        		if(currentuser == htmluserdel) {
            			document.getElementById('delwifi').style.visibility = 'visible';
        	} else {
            		document.getElementById('delwifi').style.visibility = 'hidden';
        }
    }
 	
</script>
<body onload="load(); openTab(event, 'viewNetwork'); onLoad();">
	
	

<div class="box left" style="width: 30%; height: 75%; top: 1%;">
<div class="menu_box";>
<div class="w3-container">
  <ul class="w3-navbar w3-lightblue">
    <li><a href="javascript:void(0)" class="tablink" onclick="openTab(event, 'viewNetwork');">View Network</a></li>
    <li><a href="javascript:void(0)" class="tablink" onclick="openTab(event, 'addNetwork');">Add Network</a></li>
	  
  </ul>
	
  <div id="viewNetwork" class="w3-container w3-border tab">
	
   	<div  style="font-size: 20px; top: 92%">
				<p style="color: #29afc4;" id="htmlname" href = test.html></p>
</div>
	  <div  style="font-size: 20px; top: 92%">
				<p style="font-size: 20px; color: #10454e;" id="htmladdress" href = test.html></p>
</div>
	  <div  style="font-size: 20px; top: 92%">
				<p style="font-size: 20px; color: #10454e;" id="htmlquality" href = test.html></p>
</div>
	  <div  style="font-size: 20px; top: 92%">
				<p style="font-size: 20px; color: #10454e;" id="htmltype" href = test.html></p>
</div>
	  <IMG id="htmlpicurl" SRC="htmlpicurl" ALT="" WIDTH=200 HEIGHT=200>
	  <div  style="font-size: 20px; top: 92%">
				<p style="font-size: 20px; color: #10454e;" id="htmluser" href = test.html></p>
</div>
		   <form id="deleteform" enctype="multipart/form-data" onsubmit='deleteForm("../api.php/deletewifi", "#deleteform")' method="post">
			     <div  style="font-size: 20px; top: 92%">
				<input type ="hidden" style="font-size: 20px; color: #10454e;" name="picurl" id="htmlpicurldel" href = test.html>
</div>
			   <div  style="font-size: 20px; top: 92%">
				<input type ="hidden" style="font-size: 20px; color: #10454e;" name="user" id="htmluserdel" href = test.html>
</div>
		  <div style="font-size: 20px; top: 114%">
<input style="color: #29afc4; margin-top: 10px;" id="delwifi" type="submit" name="deletewifi" value="Delete WiFi" class="tb5"> 
					
</div>
		  </form>
		  </div>
  <div id="addNetwork" class="w3-container w3-border tab">
    <!-- ADD NETWORK TAB -->
	  <form id="registerform" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" onsubmit='postForm("../api.php/addwifi", "#registerform")' method="post">
			<div style="font-size: 16px;color: #29afc4">
				To add a network, simply click on the map to set a marker for the desired location.
				For increased precision, zoom in until you can clearly distinguish roads and buildings.
				You can replace your marker by clicking on another spot on the map.
			</div>
			<div style="font-size: 20px;">
				Name of the network
			</div>
			<div style="top: 12%; font-size: 20px;">
				<input type="text" name="name" class="tb5" value="">

			</div>
			<br/>
			<div style="font-size: 20px; top: 40%; left: 8%;">
				Location(E.g Joes Coffee shop)
			</div>
			<div style="font-size: 20px; top: 40%">
				<input value="" type="text" name="address" class="tb5">
			</div>
		  	<br/>
			<div style="font-size: 20px; top: 52%; left: 8%;">
				Rating
			</div>
			<div  style="font-size: 20px; top: 52%">
				
  				<select name="quality">
   				<option value="Slow">Slow</option>
    				<option value="Decent">Decent</option>
				<option value="Great">Great</option>
  				</select>
			
			</div>
			<div style="font-size: 20px; top: 64%; left: 8%;">
				Customer only?(yes/no)
			</div>
			<div  style="font-size: 20px; top: 64%">
				
  				<select name="type">
   				<option value="Yes">Yes</option>
    				<option value="No">No</option>
  				</select>
			
			</div>
		  	<div style="font-size: 20px; top: 76%"> 
				Picture(optional, max 2mb)<br/>
			<input id="file" type="file" name="file" font="monospace" class="tb3"> 
   			
			</div>
		  	<br/>
			<div  style="font-size: 20px; top: 92%">
				<input type="hidden" id="latval" name="lat" />
			</div>
		  	<div  style="font-size: 20px; top: 92%">
				<input type="hidden" id="lonval" name="lng"/>
			</div>
			<div  style="font-size: 20px; top: 92%">
				<input id="picurl" type="hidden" value="" name="picurl"/>
			</div>
		  	<div  style="font-size: 20px; top: 92%">
				<input id="user" type="hidden" value="<?php echo $_SESSION['username']?>" name="user"/>
			</div>
			<br/>
			
		  <div style="font-size: 20px; top: 114%">
<input style="color: #29afc4; margin-top: 10px;" id="submit" type="submit" name="submit" value="Submit WiFi" class="tb5"> 
					
</div>
		  
		  
		  
		  
		
			

	   </form> 
	 
		 
	  
  </div>
</div>

			

	</div>
	
	</div>
	
	
	
	

	<script>
function openTab(evt, tabName) {
 	var holder = String(tabName);
  	var i, x, tablinks;
  	x = document.getElementsByClassName("tab");
  	for (i = 0; i < x.length; i++) {
      		x[i].style.display = "none";
  	}
	
  	tablinks = document.getElementsByClassName("tablink");
	
  	for (i = 0; i < x.length; i++) {
      		tablinks[i].className = tablinks[i].className.replace(" w3-cyan", "");
  	}
	
  	document.getElementById(tabName).style.display = "block";
  	evt.currentTarget.className += " w3-cyan";
}
   

</script>
	
	
	<div style="font-size: 18px;" onclick="logout();">
	<input type="submit" value =" Sign Out " name="register" style="color: #29afc4; position:fixed; left:23vw; bottom:20vh;" >
</div>
	

	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
	<div id="map" style="width: 70%; height: 100vh; left:30%"></div>

</body>

</html>
