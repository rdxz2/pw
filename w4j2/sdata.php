<?php
    //SAVE DATA YANG UDAH DIEDIT
    include "db.php";

    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $desc = $_POST["desc"];
    $scs = false;

    try{
        $db->prepare("UPDATE student SET fname=?, lname=?, `desc`=? WHERE id=?")
            ->execute([$fname, $lname, $desc, $id]);
        $scs = true;
    }
    catch(Exception $e){

    }

    include "db2.php";

    echo json_encode($scs);

    // session_start();

    // $students = $_SESSION["students"];

    // $nim = $_POST["snim"];
    // $fname = $_POST["sfname"];
    // $lname = $_POST["slname"];
    // $desc = $_POST["sdesc"];
    // $found = false;
    
    // //cari nim di array
    // foreach($students as $k => &$v) {
    //     if ($v["nim"] == $nim) {
    //         //edit objek
    //         $v["nim"] = $nim;
    //         $v["fname"] = $fname;
    //         $v["lname"] = $lname;
    //         $v["desc"] = $desc;
    //         $found = true;
    //         break;
    //     }
    // }
    // $_SESSION["students"] = $students;

    // echo json_encode($found);
?>