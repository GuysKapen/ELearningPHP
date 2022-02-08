<?php 
function get_contact() {
    include('connect.php');
    $query = $con->prepare("select * from contacts");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $row = $query->fetch();

    $allowed = ["email", "address_1", "address_2", "fb", "gp", "tw", "link", "phone", "yt"];
    // print_r($row);
    // return;
    $filtered = array_filter(
        $row,
        function ($key) use ($allowed) {
            return in_array($key, $allowed);
        },
        ARRAY_FILTER_USE_KEY
    );

    return $filtered;
}
