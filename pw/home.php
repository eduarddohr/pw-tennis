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
	  <a href="#rezervare" class="w3-button w3-block w3-black">REZERVA</a>
    </div>
	<div class="nav">
	  <a href="#rezervarile" class="w3-button w3-block w3-black">REZERVARILE MELE</a>
    </div>
	<div class="nav">
      <a href="#unde" class="w3-button w3-block w3-black">UNDE</a>
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
<!-- rezervare -->
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
<!-- rezervarile mele -->
<div class="w3-container" id="rezervarile">
  <div class="w3-content" style="max-width:300px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">REZERVARILE MELE</span></h5>
	<?php
		$con = mysqli_connect("localhost","root","");
		mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");
		$emailLogat = $_SESSION['user'];
		$query = mysqli_query($con,"Select * from utilizatori WHERE email = '$emailLogat'");
		$rand = mysqli_fetch_array($query); 
		$idU = $rand['id'];
		$query = mysqli_query($con, "Select * from rezervari WHERE idUtilizatori = '$idU' ORDER BY data");
		$nrRez = mysqli_num_rows($query);
		if($nrRez > 0){
			echo "
				<table width='100%'>
			";
			while($rand = mysqli_fetch_array($query, MYSQLI_BOTH)){
				$dataRez = $rand['data'];
				echo "
					<tr>
					<td>$dataRez</td>
					<td id='celula'><a href='#' onclick='stergere($rand[id])'>Sterge</a></td>
					</tr>
				";
			}
			echo "
				</table>
			";
		}
		else{
			echo "<p align='center'>Deocamdata nu aveti rezervari!</p>";
		}
	?>
  </div>
</div>

<!-- locatie -->
<div class="w3-container" id="unde" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">UNDE</span></h5>

    <div id="googleMap" style="width:100%;height:400px;"></div>
  </div>
</div>

<?php
	$con = mysqli_connect("localhost","root","");
	mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");
	$emailLogat = $_SESSION['user'];
	$query = mysqli_query($con,"Select * from utilizatori WHERE email = '$emailLogat'");
	$rand = mysqli_fetch_array($query);
	$esteAdmin = $rand['esteAdmin'];
	if($esteAdmin != 0){
		echo "
			<div class='w3-container' id='admin' style='padding-bottom:32px;'>
				<div class='w3-content' style='max-width:900px'>
					<h5 class='w3-center w3-padding-48'><span class='w3-tag w3-wide'>ADMIN</span></h5>
					<p align='center'>Lista utilizatori:</p>
					<table align='center'>
						<tr>
							<th>Nume</th>
							<th>Prenume</th>
							<th>Telefon</th>
							<th>Email</th>
							<th>Admin</th>
							<th></th>
							<th></th>
						</tr>
					
		";
		
		$query = mysqli_query($con, "Select * from utilizatori");
		while($rand = mysqli_fetch_array($query, MYSQLI_BOTH)){
				echo "
					<tr>
						<td>$rand[nume]</td>
						<td>$rand[prenume]</td>
						<td>$rand[tel]</td>
						<td>$rand[email]</td>
						<td>$rand[esteAdmin]</td>
						<td><a href='#' onclick='stergereU($rand[id])'>Sterge</a></td>
						<td><a href='#' onclick='numeste($rand[id])'>Numeste admin</a></td>
					</tr>
				";
			}
		echo "
					</table>
				<p align='center'>Lista rezervari:</p>
					<table align='center'>
						<tr>
							<th>Email</th>
							<th>Data</th>
							<th></th>
						</tr>		
		";
		$query = mysqli_query($con, "Select * from rezervari");
		while($rand = mysqli_fetch_array($query, MYSQLI_BOTH)){
			$idU = $rand['idUtilizatori'];
			$util = mysqli_query($con, "Select * from utilizatori WHERE id ='$idU'");
			$randUtil = mysqli_fetch_array($util);
				echo "
					<tr>
						<td>$randUtil[email]</td>
						<td>$rand[data]</td>
						<td><a href='#' onclick='stergere($rand[id])'>Sterge</a></td>
					</tr>
				";
			}
		echo "
					</table>
				</div>
			</div>
		";
	}
?>

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
				Print '<script>window.location.assign("home.php");</script>';
			}
		}
	}
?>
<script>
function stergere(id){
	var r = confirm("Sigur doresti sa stergi rezervarea?");
	if(r == true){
		window.location.assign("delete.php?id=" + id);
	}
}
function stergereU(id){
	var r = confirm("Sigur doresti sa stergi utilizatorul?");
	if(r == true){
		window.location.assign("deleteuser.php?id=" + id);
	}
}
function numeste(id){
	var r = confirm("Sigur doresti sa numesti administrator?");
	if(r == true){
		window.location.assign("numesteadmin.php?id=" + id);
	}
}
</script>
<script src="harta.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEIEmhck_v7L0xeSVd4aJDakWPUU9Lrcs&callback=myMap"></script>
</body>
</html>

