<div id="body-left">
    <h3>Categories Management</h3>
    <ul>
        <li><a href="index.php">Dash board</a></li>
        <li><a href="index.php?cat">View course</a></li>
        <li><a href="index.php?sub_cat">View sub course</a></li>
    </ul>
    <h3>Course Management</h3>
    <ul>
        <li><a href="">View All Active Courses</a></li>
        <li><a href="">View All Pending Courses</a></li>
        <li><a href="">View All Unpublished Courses</a></li>
        <li><a href="">Advance Couse Search</a></li>
    </ul>
    <h3>User Management</h3>
    <ul>
        <li><a href="">View All Students</a></li>
        <li><a href="">View All Teachers</a></li>
        <li><a href="">Advance User Search</a></li>
    </ul>
    <h3>Payment Management</h3>
    <ul>
        <li><a href="">Pay To Instructor</a></li>
        <li><a href="">View All Complete Orders</a></li>
        <li><a href="">Advance Order Search</a></li>
    </ul>
    <h3>Pages Management</h3>
    <ul>
        <li><a href="">Terms & Conditions</a></li>
        <li><a href="">Contact Us</a></li>
        <li><a href="">About Us</a></li>
        <li><a href="">FAQs</a></li>
        <li><a href="">Edit Slider</a></li>
    </ul>
</div>

<?php
    if (isset($_GET['cat'])) {
        include("category.php");
    }

    if (isset($_GET['sub_cat'])) {
        include("sub_category.php");
    }
 ?>