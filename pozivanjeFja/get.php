<?php

require "../dbBroker.php";
require "../oopKlase/klasakurseva.php";

if(isset($_POST['id'])){
    $myArray = Kursevi::getKurs($_POST['id'],$conn);
    echo json_encode($myArray);
}

?>