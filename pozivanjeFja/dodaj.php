<?php

require "../dbBroker.php";
require "../oopKlase/klasakurseva.php";

if(isset($_POST['jezik']) && 
isset($_POST['broj']) && isset($_POST['date'])) {
    $noviKurs = new Kursevi(null, $_POST['jezik'],$_POST['broj']
    ,$_POST['date']);
    $status = Kursevi::insertKurs($noviKurs, $conn);

    if($status) {
        echo "Success";
    }
    else { 
        echo $status;
    echo "Failed";
    }
}



?>