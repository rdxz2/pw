<?php
    include "db.php";

    $id = $_POST["id"];
    $scs = false;

    try{
        $db->exec("DELETE FROM student WHERE id = " . $id);
        $scs = true;
    }
    catch(Exception $e){

    }

    include "db2.php";

    echo json_encode($scs);

    // session_start();

    // $students = $_SESSION["students"];

    // $nim = $_POST["snim"];
    // $found = false;

    // //cari nim di array
    // foreach($students as $k => $v) {
    //     if ($v["nim"] == $nim) {
    //         //delete objek
    //         unset($students[$k]);
    //         $found = true;
    //         break;
    //     }
    // }
    
    // $_SESSION["students"] = $students;
    
    // echo json_encode($found);
?>