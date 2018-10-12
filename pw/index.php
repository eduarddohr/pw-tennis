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
</style>
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
      <a href="#login" class="w3-button w3-block w3-black">AUTENTIFICARE/INREGISTRARE</a>
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
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">DESPRE</span></h5>
    <p align="center">Cel mai bun teren de tenis de camp din oras!</p>
	<p align="center">Pretul pe ora: 30RON.</p>
  </div>
</div>


<div class="w3-container" id="rezervare">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">REZERVARE</span></h5>
    <p align="center">Pentru rezervare, autentificati-va!</p>
	<p align="center">Rezervarile de fac pe o durata de o ora!</p>
  </div>
</div>

<!-- login/logout -->
<div class="w3-container" id="login">
  <div class="w3-content" style="max-width:400px">
 
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">AUTENTIFICARE/INREGISTRARE</span></h5>
  
    <div class="w3-row w3-center w3-card w3-padding">
      <a href="javascript:void(0)" onclick="openMenu(event, 'log');" id="myLink">
        <div class="w3-col s6 tablink">Autentificare</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'signup');">
        <div class="w3-col s6 tablink">Inregistrare</div>
      </a>
    </div>

    <div id="log" class="w3-container menu w3-padding-48 w3-card">
		<form action="login.php" method="POST">
			<input class="w3-input w3-padding-16 w3-border" type="email" name="email" placeholder="Email" required="required"  /> <br/>
			<input class="w3-input w3-padding-16 w3-border" type="password" name="parola" placeholder="Parola" required="required" /> <br/>
			<button class="w3-button w3-black" type="submit">AUTENTIFICARE</button>
		</form>
    </div>

    <div id="signup" class="w3-container menu w3-padding-48 w3-card">
		<form action="index.php" method="POST">
			<input class="w3-input w3-padding-16 w3-border" type="text" name="nume" placeholder="Nume" required="required" /><br/>
			<input class="w3-input w3-padding-16 w3-border" type="text" name="prenume" placeholder="Prenume" required="required"/> <br/>
			<input class="w3-input w3-padding-16 w3-border" type="password" name="parola" placeholder="Parola" required="required" /> <br/>
			<input class="w3-input w3-padding-16 w3-border" type="tel" name="tel" placeholder="Telefon" required="required" /> <br/>
			<input class="w3-input w3-padding-16 w3-border" type="email" name="email" placeholder="Email" required="required"  /> <br/>
			<button class="w3-button w3-black" type="submit">INREGISTRARE</button>
		</form>
    </div>  
  </div>
</div>

<!-- locatie -->
<div class="w3-container" id="unde" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">UNDE</span></h5>

    <div id="googleMap" style="width:100%;height:400px;"></div>
  </div>
</div>

<!-- End page content -->
</div>



<!-- Harta -->
<script src="harta.js"></script>
<script src="logsign.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEIEmhck_v7L0xeSVd4aJDakWPUU9Lrcs&callback=myMap"></script>

</body>
</html>


<?php
	$con = mysqli_connect("localhost","root","");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$nume = mysqli_real_escape_string($con, $_POST['nume']);
		$prenume = mysqli_real_escape_string($con, $_POST['prenume']);
		$tel = mysqli_real_escape_string($con, $_POST['tel']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$parola = mysqli_real_escape_string($con, $_POST['parola']);
		
		echo $nume. $prenume. $tel. $email. $parola;
	
		$bool = true;
		mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");
		$query = mysqli_query($con,"Select * from utilizatori");
		while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
			$table_email = $row['email'];
			if($email == $table_email){
				$bool = false;
				Print '<script>alert("Email utilizat!");</script>';
				Print '<script>window.location.assign("index.php");</script>';
			}
		}
		if($bool){
			mysqli_query($con,"INSERT INTO utilizatori (nume, prenume, email, parola, tel) VALUES ('$nume', '$prenume', '$email', '$parola', '$tel')");
			Print '<script>alert("Inregistrare cu succes!");</script>';
			Print '<script>window.location.assign("index.php");</script>';
		}
		
	}
?>
