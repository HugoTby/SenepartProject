<?php

class GPS
{

    private $IdBateau_;
    private $date_;
    private $heure_;
    private $latitude_;
    private $longitude_;
    private $vitesse_;
    private $vitesseMoyenne_;

    public function __construct($IdBateau, $date, $heure, $latitude,$longitude,$vitesse,$vitesseMoyenne)
    {
        $this->IdBateau_ = $IdBateau;
        $this->date_ = $date;
        $this->heure_ = $heure;
        $this->latitude_ = $latitude;
        $this->longitude_ = $longitude;
        $this->vitesse_ = $vitesse;
        $this->vitesseMoyenne_ = $vitesseMoyenne;
    }



    public function SelectAllInDatabase()
    {
        try {
            $query = "SELECT * FROM GPS ORDER BY date DESC, heure DESC, IdBateau DESC";
            $result = $GLOBALS["pdo"]->query($query);
            
            // Renvoie les résultats sous forme de tableau associatif
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function SelectInDatabase()
    {
        try {
            $query = "SELECT * FROM GPS ORDER BY date DESC, heure DESC, IdBateau DESC LIMIT 10";
            $result = $GLOBALS["pdo"]->query($query);
            
            // Renvoie les résultats sous forme de tableau associatif
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function SetDateInDatabase($IdBateau, $date)
    {
        try {
            $query = "UPDATE `GPS` SET `date`='$date' WHERE IdBateau = $IdBateau";
            $GLOBALS["pdo"]->query($query);
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }    

    public function SetHeureInDatabase($IdBateau, $heure)
    {
        try {
            $query = "UPDATE `GPS` SET `heure`='$heure' WHERE IdBateau = $IdBateau";
            $GLOBALS["pdo"]->query($query);
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }  

    public function SetSpeedInDatabase($IdBateau, $vitesse)
    {
        try {
            $query = "UPDATE `GPS` SET `vitesse`=$vitesse WHERE IdBateau = $IdBateau";
            $GLOBALS["pdo"]->query($query);
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }    

    public function SetAverageSpeedInDatabase($IdBateau, $vitesseMoyenne)
    {
        try {
            $query = "UPDATE `GPS` SET `vitesseMoyenne`= $vitesseMoyenne WHERE IdBateau = $IdBateau";
            $GLOBALS["pdo"]->query($query);
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }    

    public function AfficheInDatabase($result)
    {
        // Vérifiez si la requête a renvoyé des résultats
        if ($result->rowCount() > 0) {
            // Parcourez chaque ligne de résultat
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "Id: " . $row['id'] . "<br>";
                echo "Date: " . $row['date'] . "<br>";
                echo "Heure: " . $row['heure'] . "<br>";
                echo "Latitude: " . $row['latitude'] . "<br>";
                echo "Longitude: " . $row['longitude'] . "<br>";
                echo "Vitesse: " . $row['vitesse'] . "<br>";
                echo "Vitesse Moyenne: " . $row['vitesseMoyenne'] . "<br>";
                echo "=========================<br>";
            }
        } else {
            echo "Aucun résultat trouvé dans la base de données.";
        }
    }

    public function toRadians($degrees) 
    {
        return $degrees * (M_PI / 180);
    }

    public function calculateDistance($radLat1, $radLon1, $radLat2, $radLon2) {
        $earthRadius = 6371; // Rayon de la Terre en kilomètres

        // Formule de la distance entre deux points sur la surface d'une sphère
        $dLat = $radLat2 - $radLat1;
        $dLon = $radLon2 - $radLon1;

        $a = sin($dLat / 2) * sin($dLat / 2) + cos($radLat1) * cos($radLat2) * sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    public function calculateSpeed($lat1, $lon1, $time1, $lat2, $lon2, $time2) 
    {
        // Convertir les coordonnées en radians
        $radLat1 = $this->toRadians($lat1);
        $radLon1 = $this->toRadians($lon1);
        $radLat2 = $this->toRadians($lat2);
        $radLon2 = $this->toRadians($lon2);

        // Calculer la distance entre les deux points en kilomètres
        $distance = $this->calculateDistance($radLat1, $radLon1, $radLat2, $radLon2);

        // Convertir le temps en secondes
        $timeDiff = strtotime($time2) - strtotime($time1);
        
        // Calculer la vitesse en kilomètres par heure
        $speed = $distance / $timeDiff * 3600;

        return $speed;
    }

    public function calculateAverageSpeed($IdBateau) 
    {
           $IdBateau = floatval($IdBateau);
        try {
            $query = "SELECT vitesse FROM GPS WHERE IdBateau <= '$IdBateau' ORDER BY date DESC, heure DESC, IdBateau DESC LIMIT 10";
            $result = $GLOBALS["pdo"]->query($query);

            /*
            $query2 = "SELECT vitesse FROM GPS WHERE IdBateau = '$IdBateau'-1 ORDER BY date DESC, heure DESC";
            $result2 = $GLOBALS["pdo"]->query($query2);
            
            $query3 = "SELECT vitesse FROM GPS WHERE IdBateau = '$IdBateau'-2 ORDER BY date DESC, heure DESC";
            $result3 = $GLOBALS["pdo"]->query($query3);
           */

            $totalSpeed = 0;
            $count = 0;

            // Parcourez chaque ligne de résultat
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $totalSpeed += $row['vitesse'];
                $count++;
            }
            /* 
            while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                $totalSpeed += $row['vitesse'];
                
                $count++;
            }
            while ($row = $result3->fetch(PDO::FETCH_ASSOC)) {
                $totalSpeed += $row['vitesse'];
                
                $count++;
            }
            */
            // Évitez la division par zéro
            if ($count > 0) {
                // Calculez la vitesse moyenne
                $averageSpeed = $totalSpeed / 10;
                return $averageSpeed;
            } else {
                return 0; // Aucune vitesse disponible pour calculer la moyenne
            }
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

}