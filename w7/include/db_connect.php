<?php
    //CONNECTION STRING : PDO
    $h = "localhost";
    $u = "root";
    $d = "pw";
    $p = "root1234";
    $db = new PDO("mysql:host=$h; dbname=$d;", $u, $p);

    //ACTION MODE
    $act = isset($_POST["act"]) ? $_POST["act"] : $_GET["act"];

    //AJAX RESPONSE
    $rs = false;
    $rt = "";
?>