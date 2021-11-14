<?php 

class Prijava {
    public $id;
   public $korisnik;
   public $lozinka;

   public function __construct($id=null, $korisnik=null, $lozinka=null) {
       $this->id = $id;
       $this->korisnik = $korisnik;
       $this->lozinka = $lozinka;
   }
   //SELECT
   /*staticka funkcija kojom proveravamo da li se user ispravno ulogovao, ukoliko 
   nije ostaje na pocetnoj strani i naglasava mu se da je prazan input*/
   public static function logovanje($kor, mysqli $conn) { 
      if(Prijava::praznaPolja($kor) == false) {
        header('Location: index.php?error=emptyinput');
        exit();
      } else { 
          //sakupljamo potrebne podatke o useru iz tabele users
       $query = "SELECT * FROM `users` WHERE users_u='$kor->korisnik' and users_p='$kor->lozinka'";
       return $conn->query($query);
   }}

   //f-ja koja proverava da li su polja popunjena
   public static function praznaPolja($kor) {
       $rezultat;
       if(empty($kor->korisnik) || empty($kor->lozinka)) {
           $rezultat = false;
       }
       else {
           $rezultat = true;
       }
       return $rezultat;
   }
}


?>