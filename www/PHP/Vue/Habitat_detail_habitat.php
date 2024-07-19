<?php
try{


    include('PHP/Model/animaux_par_habitat_infos.php');
    $habitat=$_GET['habitat'];
    for($i=0; $i<count($animaux);$i++){
        echo "<article class=\"bgelt\" onclick=\"document.location.href='detail_animal.php?Animal=".$animaux[$i]["ID"]."'\">";
        echo "<h3>".$animaux[$i]["Prenom"].", ".$animaux[$i]["race"]."</h3>";
        echo "<div>";
        $nbphoto=0;
        foreach($photosliste[$i] as $photo){
            echo '<img src="Assets/Ajouts/' .$listphoto[$photo]['Fichier'] . '">';
        }
        echo "</div>";
    echo "</article>";
    }

    
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>