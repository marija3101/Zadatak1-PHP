<?php

require "../dbBroker.php";
require "../oopKlase/klasakurseva.php";

if(isset($_POST['id']) && isset($_POST['jezik']) && 
isset($_POST['broj']) && isset($_POST['date'])) {
$noviKurs =  new Kursevi($_POST['id'], $_POST['jezik'],$_POST['broj']
,$_POST['date']);
$status = Kursevi::updateKurs($noviKurs,$conn);
if ($status){
    echo "Success";
}else{
    echo "Failed";
}
}
?>