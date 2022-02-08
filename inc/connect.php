<?php 
    try {
        $con = new pdo("mysql:host=127.0.0.1;dbname=elearning", "guysE", "GuysELearning");
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>  