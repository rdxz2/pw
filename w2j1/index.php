<?php
    $x = [
        "n1" => ["nama" => "India", "ikota" => "New Delhi", "tel" => "91", "uang" => "INR"],
        "n2" => ["nama" => "Indonesia", "ikota" => "Jakarta", "tel" => "62", "uang" => "IDR"],
        "n3" => ["nama" => "Japan", "ikota" => "Tokyo", "tel" => "81", "uang" => "JPY"],
    ];
    foreach($x as $d) echo "<i><b>" . $d["ikota"] . "</i></b> is capital ciy of <b>" . $d["nama"] . "</b>.<u> " . $d["nama"] . "'s calling code is " . $d["tel"] . ' and has "' . $d["uang"]. '" as currency code.</u><br>';
?>