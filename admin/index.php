<?php
session_start();
include_once('inc/function.php');
if (
    !isset($_SESSION['user'])
    || !is_admin($_SESSION['user'])
) {
    $_SESSION['redirect'] = 'admin/index.php';
    header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/login.php');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Home</title>

    <!-- Toast -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>

<body class="bg-white text-base dark:bg-gray-800 dark:text-gray-100 pt-20">
    <div id="app" data-v-app="">

        <?php
        if (isset($_SESSION["success_message"])) {
            echo '<script type="text/javascript">toastr.success("' . $_SESSION["success_message"] . '")</script>';
            unset($_SESSION["success_message"]);
        }
        if (isset($_SESSION["error_message"])) {
            echo '<script type="text/javascript">toastr.error("' . $_SESSION["error_message"] . '")</script>';
            unset($_SESSION["error_message"]);
        }

        ?>

        <?php
        include("inc/header.php"); ?>

        <div class="w-full">
            <?php
            include("inc/aside_bar.php");
            include("inc/body_right.php") ?>
        </div>



        <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-30" style="display: none;">
            <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 dark:via-gray-900 dark:to-gray-700 from-white via-gray-100 to-white"></div>
        </div>
    </div>

    <script src="ckeditor/ckeditor.js"></script> <!-- script for ckeditor -->

</body>

</html>