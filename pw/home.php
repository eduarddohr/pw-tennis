<!DOCTYPE html>
<html>
<title>Pagina PW</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<link rel="stylesheet" href="overwrite.css">

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
<input type="hidden" id="hiddencontainer" name="hiddencontainer"/>
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
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">DESPRE</span></h5>
    <p align="center">Cel mai bun teren de tenis de camp din oras!</p>
	<p align="center">Pretul pe ora: 30RON.</p>
  </div>
</div>

<div class="w3-container" id="rezervare">
  <div class="w3-content" style="max-width:820px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">REZERVARE</span></h5>
	<p align="center">Rezervarile de fac pe o durata de o ora!</p>
	<p align="center">Verifica disponibilitatea:</p><br/>
    <div id="calendarContainer"></div>
	<div id="organizerContainer"></div>
  </div>
</div>

<div class="w3-container" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:400px">
  <p align="center">Alege data si ora dorita:</p>
    <form action="#rezervare" method="POST">
      <p><input id="dat" class="w3-input w3-padding-16 w3-border" name="dat" type="datetime-local" placeholder="Date and time" value="2018-10-16T20:00"></p>
      <p><button type="submit" class="w3-button w3-black" onclick="adaugare()">REZERVA</button></p>
    </form>
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
<script src="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js"></script>
<script src="incarcare.js"></script>

<?php
	$con = mysqli_connect("localhost","root","");
	mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");
	$query = mysqli_query($con,"Select * from rezervari");
	while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
			$table_date = $row['data'];
			echo ("<script type='text/javascript'>
				var da = new Date('$table_date');
				createData(da.getFullYear(), da.getMonth() + 1, da.getDate(), da.getHours());
			</script>
			") ;
		}
	echo ("<script src='calendar.js'></script>");
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$cand1 = $_POST['dat'];
		$cand=date("Y-m-d H:i:s",strtotime($cand1));
		$bool = true;
		$datetime = new DateTime($cand);
		$ora = $datetime->format('H');
		if($ora < 8 || $ora > 22){
			Print '<script>alert("Interval orar nepermis!");</script>';
			Print '<script>window.location.assign("#rezervare");</script>';
		}
		else{
			mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");		
			$query = mysqli_query($con,"Select * from rezervari");
			while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
				$table_date = $row['data'];
				if($cand == $table_date){
					$bool = false;
					Print '<script>alert("Interval orar ocupat!");</script>';
					Print '<script>window.location.assign("home.php#rezervare");</script>';
				}
			}
			if($bool){
				$emailLogat = $_SESSION['user'];
				$query = mysqli_query($con,"Select * from utilizatori WHERE email = '$emailLogat'");
				$rand = mysqli_fetch_assoc($query);
				$idU = $rand['id'];
				mysqli_query($con,"INSERT INTO rezervari (idUtilizatori, data) VALUES ('$idU', '$cand')");
				Print '<script>alert("Rezervare cu succes!");</script>';
				//echo ("<script type='text/javascript'>createData('$cand'.);</script>") ;
				Print '<script>window.location.assign("home.php");</script>';
			}
		}
	}
?>

<script src="harta.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEIEmhck_v7L0xeSVd4aJDakWPUU9Lrcs&callback=myMap"></script>
</body>
</html>

