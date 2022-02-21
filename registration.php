<?php

session_start();
include("inc/connect.php");


if (isset($_POST['registration'])) {
	if (
		!isset($_POST['username']) ||
		!isset($_POST['email']) ||
		!isset($_POST['password'])
	) {
		return;
	}

	$name = $_POST['username'];
	$pass = $_POST['password'];
	$email = $_POST['email'];

	$check = $con->prepare("select 1 as result from users where email=:email and password=:password limit 1");
	$check->bindParam("email", $email);
	$check->bindParam("password", $pass);
	$check->execute();
	$count = $check->fetch()['result'];

	if ($count > 0) {
		echo "<script>alert('User already existed');</script>";
		$con = null;
		return;
	}

	$query = $con->prepare("insert into users (username, email, password) values (:username, :email, :password)");
	$query->bindParam("username", $name);
	$query->bindParam("email", $email);
	$hashed_password = password_hash($pass, PASSWORD_BCRYPT);
	$query->bindParam("password", $hashed_password);

	if ($query->execute()) {
		echo "<script>alert('Registration successfully!');</script>";
		echo "<script>window.open('index.php?sub_cat', '_self')</script>";
	} else {
		echo "<script>alert('Registration Failed!');</script>";
		echo "<script>window.open('index.php?sub_cat', '_self')</script>";
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
