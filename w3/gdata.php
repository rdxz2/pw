<?php
    $h = "localhost";
    $u = "root";
    $d = "ipcdb-dev";
    $p = "root1234";

    $all_data = array();

    //MYSQLI
    // $db = new mysqli($h, $u, $p, $d);
    // $q = "SELECT * FROM m_warehouse";
    // $res = $db->query($q);

    // while($r = $res->fetch_assoc()){
    //     $all_data[] = array(
    //         "WarehouseID" => $r["WarehouseID"],
    //         "WarehouseCode" => $r["WarehouseCode"],
    //         "WarehouseName" => $r["WarehouseName"],
    //         "WarehouseAddress" => $r["WarehouseAddress"],
    //         "Active_Flag" => $r["Active_Flag"]
    //     );
    // }

    // mysqli_free_result($res);
    // mysqli_close($db);

    //PDO
    $db = new PDO("mysql:host=$h; dbname=$d;", $u, $p);
    $q = "SELECT * FROM m_warehouse";
    $res = $db->query($q);

    foreach($res as $r){
        $all_data[] = array(
            "WarehouseID" => $r["WarehouseID"],
            "WarehouseCode" => $r["WarehouseCode"],
            "WarehouseName" => $r["WarehouseName"],
            "WarehouseAddress" => $r["WarehouseAddress"],
            "Active_Flag" => $r["Active_Flag"]
        );
    }

    $res = null;
    $db = null;
    
    echo json_encode($all_data);
    exit;
?>