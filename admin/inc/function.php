<?php
function add_cat()
{
    include("inc/connect.php");
    if (isset($_POST['add_cat'])) {
        $cat_name = $_POST["cat_name"];

        $check = $con->prepare("select 1 as result from categories where cat_name like :cat_name limit 1");
        $check->bindParam("cat_name", $cat_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Category already existed');</script>";
            $con->close();
            return;
        }

        $add_cat = $con->prepare("insert into categories (cat_name) values (:name)");
        $add_cat->bindParam("name", $cat_name);
        if ($add_cat->execute()) {
            echo "<script>alert('Add category successfully!');</script>";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        } else {
            echo "<script>alert('Add category Failed!');</script>";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        }
        $con->close();
    }
}

function add_sub_cat()
{
    include("inc/connect.php");
    if (isset($_POST['add_sub_cat'])) {
        $cat_name = $_POST["sub_cat_name"];
        $cat_id = $_POST["cat_id"];

        $check = $con->prepare("select 1 as result from sub_categories where sub_cat_name like :sub_cat_name limit 1");
        $check->bindParam("sub_cat_name", $cat_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Sub category already existed');</script>";
            $con->close();
            return;
        }

        $add_cat = $con->prepare("insert into sub_categories (sub_cat_name, cat_id) values (:name, :cat_id)");
        $add_cat->bindParam("name", $cat_name);
        $add_cat->bindParam("cat_id", $cat_id);
        if ($add_cat->execute()) {
            echo "<script>alert('Add sub category successfully!');</script>";
            echo "<script>window.open('index.php?sub_cat', '_self')</script>";
        } else {
            echo "<script>alert('Add sub category Failed!');</script>";
            echo "<script>window.open('index.php?sub_cat', '_self')</script>";
        }
        $con->close();
    }
}

function select_categories()
{
    include("inc/connect.php");
    $sel_cat = $con->prepare("select * from categories");
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $cats = array();
    while($row = $sel_cat->fetch()) {
        array_push($cats, array("name" => $row["cat_name"], "id" => $row["cat_id"]));
    }
    return $cats;
}
