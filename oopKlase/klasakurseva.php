<?php
class Kursevi {
    public $id;
    public $jezik;
    public $br;
    public $dat;


    public function __construct($id=null,$jezik=null,$br=null, $dat=null) {
        $this->id=$id;
        $this->jezik=$jezik;
        $this->br=$br;
        $this->dat=$dat;
    }
    //SELECT
        public static function printKurs(mysqli $conn) {
            $query = "SELECT * FROM podaci"; 
            return $conn->query($query);
        }
    //SELECT
        public function getKurs($id,mysqli $conn) {
            $query = "SELECT * FROM podaci WHERE id=$id";
            $objekat = array();
            if($sqlObjekat = $conn->query($query)){
                while($red = $sqlObjekat->fetch_array(1)){
                    $objekat[]= $red;
                }
            }

        return $objekat;

        }
    //DELETE
        public function obrisiKurs(mysqli $conn) {
            $query = "DELETE FROM podaci WHERE id=$this->id";
            return $conn->query($query);
        }
    //UPDATE
        public static function updateKurs(Kursevi $nov,mysqli $conn) {
        $query = "UPDATE podaci set jezik = '$nov->jezik', broj = '$nov->br', 
        date = '$nov->dat' WHERE id='$nov->id'";
        return $conn->query($query);

        }
    //INSERT
        public static function insertKurs(Kursevi $novi,mysqli $conn) {
            $query = "INSERT INTO podaci (jezik, broj, date)
             VALUES 
            ('$novi->jezik','$novi->br', 
            '$novi->dat')";
            return $conn->query($query);
        }
      
       
    
}




?>