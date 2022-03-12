<?php

session_start();
include("../connect.php");


if (isset($_POST['login'])) {
    if (
        !isset($_POST['email']) ||
        !isset($_POST['password'])
    ) {
        return;
    }

    $pass = $_POST['password'];
    $email = $_POST['email'];

    $check = $con->prepare("select * from users where email=:email limit 1");
    $check->bindParam("email", $email);
    $check->execute();
    $user = $check->fetch();
    $hashed_password = $user['password'];

    if ($hashed_password == null) {
        echo "<script>alert('Incorrect email or password');</script>";
        $con = null;
        return;
    }

    if (password_verify($pass, $hashed_password)) {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning\/' . $_SESSION['redirect'] ?? 'index.php');
        $con = null;
        $_SESSION['user'] = $user['id'];
        return;
    } else {
        echo "<script>alert('Incorrect email or password');</script>";
        $con = null;
        return;
    }

    $con = null;
}


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
