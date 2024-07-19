<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM horaire");
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultat as $result) {
        $matin1 = [];
        $matin2 = [];
        $am1 = [];
        $am2 = [];
        $val = "";
        $actual = 1;

        foreach ($result as $day) {
            foreach (str_split($day) as $letter) {
                if ($letter == "/") {
                    if ($actual == 1) {
                        array_push($matin1, $val);
                        $actual++;
                    } elseif ($actual == 2) {
                        array_push($matin2, $val);
                        $actual++;
                    } elseif ($actual == 3) {
                        array_push($am1, $val);
                        $actual++;
                    } elseif ($actual == 4) {
                        array_push($am2, $val);
                        $actual = 1;
                    }
                    $val = "";
                } else {
                    $val .= $letter;
                }
            }
            array_push($am2, $val);
            $val = "";
            $actual = 1;
        }


    } 
}catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
