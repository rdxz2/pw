<?php
    $n;
    $captcha;
    if(isset($_POST["n"])) $n = $_POST["n"];
    if(isset($_POST["g-recaptcha-response"])) $captcha = $_POST["g-recaptcha-response"];

    if(!$captcha){
        echo "<h2>check captcha form.</h2>";
        exit;
    }

    $str = "https://www.google.com/recaptcha/api/siteverify?secret=..."."&response=".$captcha."&remoteip=".$_SERVER["REMOTE_ADDR"];

    $res = file_get_contents($str);
    $resarr = (array) json_decode($res);

    if(!$resarr["success"]) echo "???";
    else echo "hai $n";
?>