<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefon liste</title>
</head>
<body>
    <?php

    class Mitarbeiter {
        public $id;
        public $gender;
        public $person;
        public $fa;
        public $GF;
        public $status;
        public $perso_nr;
        public $vorname;
        public $abteilung;
        public $telefonBuero;
        public $telefonMobil;
        public $email;
        public $az_soll;
        public $pause_soll;
        public $anzeige;


        public function __construct(int $id, String $gender, String $person, String $fa, String $gf, int $status, String $perso_nr, String $vorname, String $abteilung, String $telefonBuero, String $telefonMobil, String $email, String $az_soll, String $pause_soll, int $anzeige){
            $this->id = $id;
            $this->gender = $gender;
            $this->person = $person;
            $this->fa = $fa;
            $this->gf = $gf;
            $this->status = $status;
            $this->perso_nr = $perso_nr;
            $this->vorname = $vorname;
            $this->abteilung = $abteilung;
            $this->telefonBuero = $telefonBuero;
            $this->telefonMobil = $telefonMobil;
            $this->email = $email;
            $this->az_soll = $az_soll;
            $this->pause_soll = $pause_soll;
            $this->anzeige = $anzeige;
        }
    }

    // Datenbank daten eintragen
        $_SERVERNAME = "localhost";
        $username = "garbe";
        $password = "garbe";
        $dbname = "panel";

        //verbindung herstellen
            //verbindung herstellen
        $mysqli = new mysqli($_SERVERNAME, $username, $password, $dbname);
        if ($mysqli->connect_errno) {
            die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
        }

        $sql = "SELECT * from telefonliste.panel";
        $result = $mysqli->query($sql);

        $workerArray = array();

        if ($result->num_rows > 0){
            
            while($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"] . " |Gender: " . $row["gender"] . "|Person: " . $row["person"] . " |FA: " . $row["fa"] . "|Status: " . $row["status"] . " |Perso_nr: " . $row["perso_nr"] . " |vorname: " . $row["vorname"] . "|abteilung: " . $row["abteilung"] . " |telBüro: " . $row["telefonBuero"] . " |telMobil: " . $row["telefonMobil"] . "|email: " . $row["email"] . " |az_soll: " . $row["az_soll"] . "|pause_soll: " . $row["pause_soll"] . " |anzeige: " . $row["anzeige"];
                $mitarbeiter = new Mitarbeiter($row["id"], $row["gender"], $row["person"], $row["fa"], $row["gf"], $row["status"], $row["perso_nr"], $row["vorname"], $row["abteilung"], $row["telefonBuero"], $row["telefonMobil"], $row["email"], $row["az_soll"], $row["pause_soll"], $row["anzeige"]);
                
                array_push($workerArray, $mitarbeiter);
            }
        }else{
            echo "0 results";
        }

        echo sizeof($workerArray);

        $mysqli->close();
        

        $TESTarray = array();
        for ($i=0; $i < 88; $i++) { 
            $TESTmitarbeiter = new Mitarbeiter(10, "Hr.", "Schumacher", "_AT", "0", 0, "", "Oliver", "Geschäftsführung", "162", "0163/7019340", "", "08:00:00", "01:00:00", 1);
            array_push($TESTarray, $TESTmitarbeiter);
        }
        
        $json = json_encode($TESTarray);

        if (file_put_contents("data.json", $json))
            echo "JSON file created successfully";
        else
            echo "Error"


    ?>
</body>
</html>