<!DOCTYPE html>
<html>
<title>Pagina PW</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}
.bgimg {
    background-position: center;
    background-size: cover;
    background-image: url("header.jpg");
    min-height: 75%;
}
.menu {
    display: none;
}
.w3-block{
	display:block;
	width:100%;
	}
.nav{
	float:left;
	width:20%;
}


#calendarContainer,
#organizerContainer {
  float: left;
  margin: 5px;
}

.year,.month,.date{
	width:100% !important;
}

</style>
<head>
<?php
	session_start();
	if($_SESSION['user']){ //verifici daca e logat cineva
		
	}
	else{
		header("location:index.php");
	}
	$user = $_SESSION['user'];
?>
    <link href="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.css" rel="stylesheet" />

</head>

<body>

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="nav">
      <a href="#" class="w3-button w3-block w3-black">ACASA</a>
    </div>
    <div class="nav">
      <a href="#despre" class="w3-button w3-block w3-black">DESPRE</a>
    </div>
    <div class="nav">
      <a href="#unde" class="w3-button w3-block w3-black">UNDE</a>
    </div>
	<div class="nav">
      <a href="#rezervare" class="w3-button w3-block w3-black">REZERVA</a>
    </div>
	<div class="nav">
      <a href="logout.php" class="w3-button w3-block w3-black">IESIRE DIN CONT</a>
    </div>
  </div>
</div>

<!-- poza+text -->
<header class="bgimg w3-display-container " id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Deschis de la 08:00 pana la 23:00</span>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white" style="font-size:90px">NUME<br></span>
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-large">
    <span class="w3-text-white">adresa</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- despre -->
<div class="w3-container" id="despre">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">CEVA</span></h5>
    <p>O descriere</p>
  </div>
</div>

<div class="w3-container" id="rezervare">
  <div class="w3-content" style="max-width:820px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">REZERVARE</span></h5>
    <div id="calendarContainer"></div>
	<div id="organizerContainer"></div>
  </div>
</div>



<!-- locatie -->
<div class="w3-container" id="unde" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">UNDE</span></h5>

    <div id="googleMap" class="w3-sepia" style="width:100%;height:400px;"></div>
  </div>
</div>

<!-- End page content -->
</div>



<!-- Harta -->
<script src="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js"></script>
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: true,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}
"use strict";

// function that creates dummy data for demonstration
function createDummyData() {
  var date = new Date();
  var data = {};

  for (var i = 0; i < 10; i++) {
    data[date.getFullYear() + i] = {};

    for (var j = 0; j < 12; j++) {
      data[date.getFullYear() + i][j + 1] = {};

      for (var k = 0; k < Math.ceil(Math.random() * 10); k++) {
        var l = Math.ceil(Math.random() * 28);

        try {
          data[date.getFullYear() + i][j + 1][l].push({
            startTime: "10:00",
            endTime: "12:00",
            text: "Some Event Here"
          });
        } catch (e) {
          data[date.getFullYear() + i][j + 1][l] = [];
          data[date.getFullYear() + i][j + 1][l].push({
            startTime: "10:00",
            endTime: "12:00",
            text: "Some Event Here"
          });
        }
      }
    }
  }

  return data;
}

// creating the dummy static data
var data = createDummyData();

// initializing a new calendar object, that will use an html container to create itself
var calendar = new Calendar(
  "calendarContainer", // id of html container for calendar
  "small", // size of calendar, can be small | medium | large
  [
    "Monday", // left most day of calendar labels
    3 // maximum length of the calendar labels
  ],
  [
    "#616161", // primary color
    "#000", // primary dark color
    "#fff", // text color
    "#fff" // text dark color
  ]
);

// initializing a new organizer object, that will use an html container to create itself
var organizer = new Organizer(
  "organizerContainer", // id of html container for calendar
  calendar, // defining the calendar that the organizer is related to
  data // giving the organizer the static data that should be displayed
);

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>

