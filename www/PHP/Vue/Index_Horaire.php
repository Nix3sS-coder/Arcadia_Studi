<?php


try {
    include("PHP/Model/Horaire_infos.php");
    echo '<table>
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Lundi</th>
            <th scope="col">Mardi</th>
            <th scope="col">Mercredi</th>
            <th scope="col">Jeudi</th>
            <th scope="col">Vendredi</th>
            <th scope="col">Samedi</th>
            <th scope="col">Dimanche</th>
        </tr>
    </thead>
    <tbody>';


        echo '<tr><th scope="row">Début de journée</th>';
        for ($i = 0; $i < 7; $i++) {
            echo '<td>' . (isset($matin1[$i]) ? htmlspecialchars($matin1[$i]) : '') . '</td>';
        }
        echo '</tr>';

        echo '<tr><th scope="row">Reprise déjeuner</th>';
        for ($i = 0; $i < 7; $i++) {
            echo '<td>' . (isset($matin2[$i]) ? htmlspecialchars($matin2[$i]) : '') . '</td>';
        }
        echo '</tr>';

        echo '<tr><th scope="row">Déjeuner</th>';
        for ($i = 0; $i < 7; $i++) {
            echo '<td>' . (isset($am1[$i]) ? htmlspecialchars($am1[$i]) : '') . '</td>';
        }
        echo '</tr>';

        echo '<tr><th scope="row">Fin de journée</th>';
        for ($i = 0; $i < 7; $i++) {
            echo '<td>' . (isset($am2[$i]) ? htmlspecialchars($am2[$i]) : '') . '</td>';
        }
        echo '</tr>';
    

    echo '</tbody></table>';

    // Inclusion du footer


} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

?>
