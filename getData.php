<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefon liste</title>
</head>
<body>
    <?php

    $workerArray = array();

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

        if ($result->num_rows > 0){
            $i = 0;
            while($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"] . " |Gender: " . $row["gender"] . "|Person: " . $row["person"] . " |FA: " . $row["fa"] . "|Status: " . $row["status"] . " |Perso_nr: " . $row["perso_nr"] . " |vorname: " . $row["vorname"] . "|abteilung: " . $row["abteilung"] . " |telBüro: " . $row["telefonBuero"] . " |telMobil: " . $row["telefonMobil"] . "|email: " . $row["email"] . " |az_soll: " . $row["az_soll"] . "|pause_soll: " . $row["pause_soll"] . " |anzeige: " . $row["anzeige"];
                $mitarbeiter = new Mitarbeiter($row["id"], $row["gender"], $row["person"], $row["fa"], $row["gf"], $row["status"], $row["perso_nr"], $row["vorname"], $row["abteilung"], $row["telefonBuero"], $row["telefonMobil"], $row["email"], $row["az_soll"], $row["pause_soll"], $row["anzeige"]);
                $workerArray[$i] = $mitarbeiter;
                $i++;
            }
        }else{
            echo "0 results";
        }

        

        $mysqli->close();
        
        $TESTmitarbeiter = new Mitarbeiter(1, "gender", "person", "fa", "gf", 1, "perso_nr", "vorname", "abteilung", "telefonBuero", "telefonMobil", "email", "az_soll", "pause_soll", 1);

        echo json_encode($TESTmitarbeiter);


    ?>
</body>
</html>