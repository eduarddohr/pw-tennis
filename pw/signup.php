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