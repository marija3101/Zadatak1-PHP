<?php

require "../dbBroker.php";
require "../oopKlase/klasakurseva.php";

if(isset($_POST['id'])){
    $obj = new Kursevi($_POST['id']);
    $status = $obj->obrisiKurs($conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>