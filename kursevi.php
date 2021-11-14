<?php 
require "dbBroker.php";
require "oopKlase/klasakurseva.php";

session_start();
if(!isset($_SESSION['users_id'])) {
    header('Location: index.php');
    exit();
}

$kursevi = Kursevi::printKurs($conn);

if(!$kursevi) {
    echo "Greska!";
    exit();
}
if($kursevi->num_rows==0) {
    echo "Nema kurseva!";
    die();
}
else {


  

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

    <title>Kursevi</title>
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
                <a  class="navbar-brand" href="index.php"><b>KURSEVI JEZIKA</b></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Početna</a></li>
                <li class="active"><a href="kursevi.php">Kursevi</a></li>
            </ul>
            <form class="navbar-form navbar-right" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" id="polje" onkeyup="pretraga()" placeholder="Pretrazi kurseve..">
                </div>
                <button type="submit" name="submit" class="btn btn-info">Putem levog polja možete naći kurs</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <div>
  <div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<b><i>Prijavljeni ste na sajt, možete zakazati termin za željeni kurs!</i></b>
</div>
  </div>
  <div class="container-fluid">
  <div class="col-md-7">
      <p>DOSTUPNI KURSEVI</p>

  <table class="table table-striped table-bordered table-condensed" style="color: black;" id="tabelaid">
    <thead>
        <tr>
           <th onclick="sortirajTabelu(0)">Naziv krusa</th>
            <th onclick="sortirajTabelu(1)">Broj učenika</th>
            <th onclick="sortirajTabelu(2)">Datum</th>
            <th onclick="sortirajTabelu(3)">Komande</th>
        </tr>
</thead>
<tbody>
<?php
foreach($kursevi as $kr): 
?>

    <tr>
        <td>  <?php echo $kr['jezik'];?> </td>
        <td>  <?php echo $kr['broj'];?> </td>
        <td>  <?php echo $kr['date'];?> </td>
        <td class="text-right">
        <button class="btn btn-primary urediti" data-toggle="modal" data-target="#uredi">Uredi</button>
        <button type="button" class="btn btn-primary obrisi" formmethod="post">Obriši</button>
        </td>
        <td>
            <label class="form-check-label">
                <input type="checkbox" name="cekirano" value="<?php echo $kr['id'];?> ">
                <span class="checkmark"></span> <!-- ne znam sta je -->
</label>
        </td>
    
     </tr>
<?php
  endforeach;
}
?>
</tbody>
</table>
<hr>
<div class="row">
    <div class="col-md-12">
    <button id="btn2" type="button" 
    class="btn btn-primary btn-block" 
    data-toggle="modal" data-target="#dodaj">
    Zakaži kurs
  </button>
    </div>
</div>
<hr>
<blockquote><p class="pasus">Jezik možete naučiti samo uz jaku motivaciju – razvijajte duboko u sebi želju za učenjem  stranog jezika. 
    Motivišite sami sebe i kad je najteže. 
    Razmislite o opravdanosti razloga: nemam vremena, nemam para, ne ide mi. Možda tako samo opravdavate sebe.
Potrudite se – jasno vam je da je poznavanje bar jednog stranog jezika stvar opšte kulture i vaša nasušna potreba, 
ali razmislite koliko energije i rada stvarno u to ulažete.</p></blockquote>
</div>
<div class="col-md-5">
<div>
<button id="submit" type="submit" class="btn btn-info btn-block">Kada kliknete na "Naziv kursa" u tabeli moći ćete da je sortirate!</button>
</div>
<img src="img/kursevi.jpeg" alt="kursevi" class="img-responsive">
</div>
</div>
</div>


<!-- DODAJ Modal -->
<div class="modal fade" id="dodaj" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Zakažite kurs</h3>
        <button type="button" class="close"
         data-dismiss="modal" 
         aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="#" id="dodajForm">
                <div class="drugaforma">
                <div class="forma">
                    <label for="jezik">Izaberite jezik: </label>
                    <select name="jezik" class="form-control">
                    <option>Engleski</option>
                    <option>Francuski</option>
                    <option>Italijanski</option>
                    <option>Španski</option>
                    <option>Grčki</option>
                    <option>Turski</option>
                  </select>
                </div>
                <div class="forma">
                    <label for="broj">Broj učenika: </label>
                    <input class="form-control" type="number" 
                    name="broj" placeholder="Broj ucenika">
                    </div>
                    <div class="forma">
                    <label for="date">Datum i vreme: </label>
                    <input class="form-control" type="datetime-local" 
                    name="date" placeholder="Datum i vreme">
                    </div>
                    <div class="forma">
                    <button id="submit" type="submit" class="btn btn-success">Sačuvaj</button>
                    </div>
                    </div>
            </form>
      </div>
    </div>
  </div>
</div>


<!-- UREDI Modal -->
<div class="modal fade" id="uredi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Uredite kurs</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form method="post" action="#" id="urediForm">
      <div class="drugaforma">
      <div class="forma">
                  <input id="id" type="text" name="id" 
                  class="form-control" value="" readonly>
                </div>
                <div class="forma">
                    <label for="jezik">Izaberite jezik: </label>
                    <select name="jezik" id="jezik" class="form-control" value="">
                    <option>Engleski</option>
                    <option>Francuski</option>
                    <option>Italijanski</option>
                    <option>Španski</option>
                    <option>Grčki</option>
                    <option>Turski</option>
                  </select>
                </div>
                <div class="forma">
                    <label for="broj">Broj ucenika: </label>
                    <input class="form-control" type="number" id="broj" 
                    name="broj" value="" placeholder="Broj ucenika">
                    </div>
                    <div class="forma">
                    <label for="date">Datum i vreme: </label>
                    <input class="form-control" type="datetime-local" id="date" 
                    name="date" value="" placeholder="Datum i vreme">
                    </div>
                    <div class="forma">
                    <button id="submit2" type="submit" 
                    class="btn btn-success">Sačuvaj</button>
                    </div>
                    </div>
</form>
      </div>
      </div>
    </div>
  </div>
</div>


<script>
function sortirajTabelu(n) {
  var tabela, redovi, zamene, i, x, y, potrebnaZamena, smer, brojZamena = 0;
  tabela = document.getElementById("tabelaid");
  zamene = true;
  //nacin na koji ce se sortirati
  smer = "asc"; 
  //Petlja nastavlja sve dok nije sve zamenjeno
  while (zamene) {
    //pocinje sa nema zamena
    zamene = false;
    redovi = tabela.rows;
    //Prolazi se kroz sve redovi osim kroz heder
    for (i = 1; i < (redovi.length - 1); i++) {
      //pocinje se sa tim da nije potrebna zamena
        potrebnaZamena = false;
      //Dva susedna reda, jedan ispod drugog se uzimaju
      x = redovi[i].getElementsByTagName("TD")[n];
      y = redovi[i + 1].getElementsByTagName("TD")[n];
      /*Proveravamo da li je potrebna zamena na osnovu
      smera koji je ili asc(od pocetka abecede) ili desc(od kraja abecede)*/
      if (smer == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //Za asc ako je if tacan zamena je potrebna i postavlja se break da izadje
            potrebnaZamena= true;
          break;
        }
      } else if (smer == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //Za desc ako je if tacan zamena je potrebna i postavlja se break da izadje
            potrebnaZamena = true;
          break;
        }
      }
    }
    if (potrebnaZamena) {
      //Biramo da li je zamena potrebna, na osnovu prethodnog
      redovi[i].parentNode.insertBefore(redovi[i + 1], redovi[i]);
      zamene = true;
      //kad se odradi zamena broj se poveca za 1
        brojZamena ++;      
    } else {
      /*Ako nije odradjena zamena i smer je asc
      postavljamo suprotan smer i ponovo prolazimo kroy while petlju*/
      if (brojZamena == 0 && smer == "asc") {
        smer = "desc";
        zamene = true;
      }
    }
  }
}



function pretraga() {
  //Prvo deklarisemo promenljive 
  var polje, pretraga, tabela, tr, td, i, vrednost;
  polje = document.getElementById("polje");
  pretraga = polje.value.toUpperCase();
  tabela = document.getElementById("tabelaid");
  tr = tabela.getElementsByTagName("tr");
  //zatim prolazimo kroz sve redove i sakrivamo one koji ne odgovaraju
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      vrednost = td.textContent || td.innerText;
      if (vrednost.toUpperCase().indexOf(pretraga) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script src="main.js"></script>

</body>
</html>