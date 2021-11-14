<?php
require "dbBroker.php";
include "oopKlase/klasaprijave.php";
session_start();
if(isset($_POST['name']) && isset($_POST['password'])) {

    $korisnik = $_POST['name'];
    $lozinka = $_POST['password'];


    $prijava = new Prijava(1,$korisnik,$lozinka);
    $log =  Prijava::logovanje($prijava ,$conn);
    if($log->num_rows > 0) { 
        $_SESSION['users_id'] = $prijava->id;
        header('Location: kursevi.php');
        exit();
        //ovde naglsavamo da korisnik nije u bazi i ne moze pristupiti
    }  else{
        header('Location: index.php?error=userNotInDatabase');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
    <title>Početna</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><b>KURSEVI JEZIKA</b></a>
</div>
            <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Početna</a></li>
                <li><a href="kursevi.php">Kursevi</a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="col-md-5">
            <img src="img/pocetna.jpeg" alt="pocetna" class="img-responsive">
        </div>
        <div class="col-md-7">
            <h1 class="naslov">Dobrodošli!</h1>
           <p class="naslov"> Ulogujte se kako biste izabrali željeni kurs.</p>
            <form method="POST" action="#">
                <div class="celaforma">
                <div class="forma">
                    <label for="name">Ime i prezime: </label>
                    <input class="form-control" type="text" name="name" placeholder="Ime i prezime">
                </div>
                <div class="forma">
                    <label for="password">Šifra: </label>
                    <input class="form-control" type="password" name="password" placeholder="Sifra">
                </div>
                <div class="forma">
                <button class="btn btn-primary btn-lg" name="submit">Prijavite se</button>
                </div>
                </div>
            </form>
        </div>

    </div>
</div>
    </div>
</body>
</html>