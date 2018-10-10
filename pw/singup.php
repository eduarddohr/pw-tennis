<!DOCTYPE html>
<html>
	<head>
		<title>Pagina de inregistrare</title>
	<head>
	<body>
		<h2>Pagina de inregistrare</h2>
		<form action="singup.php" method="POST">
			Nume: <input type="text" name="nume" required="required" /> <br/>
			Prenume: <input type="text" name="prenume" required="required" /> <br/>
			Parola: <input type="password" name="parola" required="required" /> <br/>
			Telefon: <input type="tel" name="tel" required="required" /> <br/>
			Email: <input type="email" name="email" required="required"  /> <br/>
			<input type="submit" value="Inregistrare"/>
		</form>
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
				Print '<script>window.location.assign("singup.php");</script>';
			}
		}
		if($bool){
			mysqli_query($con,"INSERT INTO utilizatori (nume, prenume, email, parola, tel) VALUES ('$nume', '$prenume', '$email', '$parola', '$tel')");
			Print '<script>alert("Inregistrare cu succes!");</script>';
			Print '<script>window.location.assign("singup.php");</script>';
		}
		
	}
?>