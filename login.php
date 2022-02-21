<?php

session_start();
include("inc/connect.php");


if (isset($_POST['login'])) {
	if (
		!isset($_POST['email']) ||
		!isset($_POST['password'])
	) {
		return;
	}

	$pass = $_POST['password'];
	$email = $_POST['email'];

	$check = $con->prepare("select password from users where email=:email limit 1");
	$check->bindParam("email", $email);
	$check->execute();
	$hashed_password = $check->fetch()['password'];

	if ($hashed_password == null) {
		echo "<script>alert('Incorrect email or password');</script>";
		$con = null;
		return;
	}

	if (password_verify($pass, $hashed_password)) {
		echo "<script>alert('Login successful!');</script>";
		$con = null;
		$_SESSION['username'] = $name;
		return;
	} else {
		echo "<script>alert('Incorrect email or password');</script>";
		$con = null;
		return;
	}

	$con = null;
}


// $con = mysqli_connect('127.0.0.1', 'uniqueDev', 'uniqueDev');

// if ($con) {
// 	echo "connection successful";
// } else {
// 	echo "no connection";
// }

// mysqli_select_db($con, 'uniquedeveloper');
// $name = $_POST['name'];
// $pass = $_POST['password'];
// $email = $_POST['email'];

// $q = "select * from login where username='$name' && password='$pass'";

// $result = mysqli_query($con, $q);
// $num = mysqli_num_rows($result);
// if ($num == 1) {
// 	"duplicate data";
// 	header('location:signup.html');
// } else {
// 	$qy = "insert into login(username,password,email) values('$name','$pass','$email')";
// 	mysqli_query($con, $qy);
// 	echo "inserted";
// 	header('location:login.php');
// }
