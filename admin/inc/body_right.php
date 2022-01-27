<?php
    if (isset($_GET['cat'])) {
        include("category.php");
    }

    if (isset($_GET['sub_cat'])) {
        include("sub_category.php");
    }

    if (isset($_GET['edit_cat'])) {
        include("edit_category.php");
    }

    if (isset($_GET['edit_sub_cat'])) {
        include("edit_sub_category.php");
    }
 ?>