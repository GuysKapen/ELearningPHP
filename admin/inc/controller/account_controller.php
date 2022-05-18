<?php

session_start();
include("../connect.php");

if (isset($_POST['update_account'])) {
    if (
        !isset($_POST['email']) ||
        !isset($_POST['username']) ||
        !isset($_POST['role_id'])
    ) {

        $_SESSION["failed_message"] = "Invalid arguments";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
        return;
    }

    $role_id = $_POST['role_id'];
    $pass = $_POST['old_password'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $new_pass = $_POST['new_password'];
    $id = $_POST['id'];

    if (!empty($pass) && !empty($new_pass)) {
        $check = $con->prepare("select * from users where id=:id limit 1");
        $check->bindParam("id", $id);
        $check->execute();
        $user = $check->fetch();
        $hashed_password = $user['password'];

        if ($hashed_password == null) {
            $_SESSION["failed_message"] = "Invalid arguments";
            $con = null;
            return;
        }

        if (password_verify($pass, $hashed_password)) {

            $query = $con->prepare("update users set username=:username, email=:email, password=:password, role_id=:role_id, phone=:phone");
            $query->bindParam("username", $name);
            $query->bindParam("email", $email);
            $query->bindParam("phone", $phone);
            $query->bindParam("role_id", $role_id);
            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
            $query->bindParam("password", $hashed_password);

            if ($query->execute()) {
                $_SESSION["success_message"] = "Update account successfully!";
                header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
            } else {
                $_SESSION["failed_message"] = "Update account failed";
                header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
            }
        } else {
            $_SESSION["failed_message"] = "Incorrect email or password";
            header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
            $con = null;
            return;
        }
    } else {
        $query = $con->prepare("update users set username=:username, email=:email, role_id=:role_id, phone=:phone where id=:id");
        $query->bindParam("username", $name);
        $query->bindParam("email", $email);
        $query->bindParam("phone", $phone);
        $query->bindParam("id", $id);
        $query->bindParam("role_id", $role_id);

        if ($query->execute()) {
            $_SESSION["success_message"] = "Update account successfully!";
            header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
        } else {
            $_SESSION["failed_message"] = "Update account failed";
            header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
        }
    }

    $con = null;
}


if (isset($_POST['del_account'])) {
    include $_SERVER["DOCUMENT_ROOT"] . "/ELearning/admin/inc/function.php";
    if (
        !isset($_SESSION['user'])
        || !is_admin($_SESSION['user'])
    ) {
        $_SESSION['redirect'] = 'admin/index.php';
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/login.php');
    }

    $account_id = $_POST['account_id'];
    $q = $con->prepare("DELETE FROM users WHERE id=:account_id");
    $q->bindParam("account_id", $account_id);
    $r = $q->execute();
    if ($r == true) {
        $_SESSION["success_message"] = "Delete account successfully!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
    } else {
        $_SESSION["failed_message"] = "Delete account failed!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin?account');
    }
}
