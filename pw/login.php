<?php
	session_start();
	$con = mysqli_connect("localhost","root","");
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$parola = mysqli_real_escape_string($con, $_POST['parola']);
	mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");
	$query = mysqli_query($con,"Select * from utilizatori WHERE email='$email'");
	$este = mysqli_num_rows($query);
	$bd_email = "";
	$bd_parola = "";
	if($este > 0){
		$rand = mysqli_fetch_assoc($query);
		$bd_email = $rand['email'];
		$bd_parola = $rand['parola'];
		if(($bd_email == $email) && ($bd_parola == $parola)){
			$_SESSION['user'] = $email; //salvezi cine e logat
			header("location: home.php");
		}
		else{
			Print '<script>alert("Parola Incorecta!");</script>';
			Print '<script>window.location.assign("index.php#login");</script>'; 
		}
	}
	else{
		Print '<script>alert("Email Incorect!");</script>';
		Print '<script>window.location.assign("index.php#login");</script>'; 
	}
	
?>