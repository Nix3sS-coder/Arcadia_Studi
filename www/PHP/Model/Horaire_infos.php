<?php

try {
    // Ensure this path is correct relative to the location of Horaire_infos.php
    include(__DIR__ . '/infosbase.php');
    
    // Initialize variables
    $matin1 = [];
    $matin2 = [];
    $am1 = [];
    $am2 = [];

    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM horaire");
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultat as $result) {
        foreach ($result as $day) {
            $val = "";
            $actual = 1;

            foreach (str_split($day) as $letter) {
                if ($letter == "/") {
                    if ($actual == 1) {
                        $matin1[] = $val;
                        $actual++;
                    } elseif ($actual == 2) {
                        $matin2[] = $val;
                        $actual++;
                    } elseif ($actual == 3) {
                        $am1[] = $val;
                        $actual++;
                    } elseif ($actual == 4) {
                        $am2[] = $val;
                        $actual = 1;
                    }
                    $val = "";
                } else {
                    $val .= $letter;
                }
            }
            // Add the last value
            if ($actual == 1) {
                $matin1[] = $val;
            } elseif ($actual == 2) {
                $matin2[] = $val;
            } elseif ($actual == 3) {
                $am1[] = $val;
            } elseif ($actual == 4) {
                $am2[] = $val;
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
