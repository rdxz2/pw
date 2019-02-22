<?php
    //AMBIL DATA UNTUK edit.php
    include "db.php";

    $id = $_GET["id"];
    
    $res = $db->query("SELECT * FROM student WHERE id = " . $id)->fetch();

    $data = array(
        "id" => $res["id"],
        "nim" => $res["nim"],
        "fname" => $res["fname"],
        "lname" => $res["lname"],
        "desc" => $res["desc"],
    );

    include "db2.php";
    
    echo json_encode($data);

    // session_start();

    // $students = $_SESSION["students"];

    // $nim = $_GET["snim"];
    
    // //cari nim di array
    // foreach($students as $k => $v) {
    //     if ($v["nim"] == $nim) {
    //         //ambil objek
    //         $d = $v;
    //         break;
    //     }
    // }
    
    // echo json_encode($d);
?>