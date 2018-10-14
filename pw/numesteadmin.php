<?php
	session_start();
	if($_SESSION['user']){ //verifici daca e logat cineva
		
	}
	else{
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$con = mysqli_connect("localhost","root","");
		mysqli_select_db($con,"tenis") or die("Nu se poate accesa baza de date");
		$id = $_GET['id'];
		mysqli_query($con, "UPDATE utilizatori SET esteAdmin = 1 WHERE id = '$id'");
		header("location:home.php#admin");
	}
?>