<?php function add_cat()
{
    include("inc/connect.php");
    if (isset($_POST['cat_name'])) {
        $cat_name = $_POST["cat_name"];
        
        $check = $con->prepare("select 1 as result from category where cat_name like :cat_name limit 1");
        $check->bindParam("cat_name", $cat_name);
        $check->execute();
        $count = $check->fetch()['result'];
        
        if ($count > 0) {
            echo "<script>alert('Category already existed');</script>";
            $con->close();
            return;
        }
        
        $add_cat = $con->prepare("insert into category (cat_name) values (:name)");
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
