<?php

if( isset($_GET['Avis']) && isset($_GET['Pseudo']) ){
    $avis=$_GET['Avis'];
    $pseudo=$_GET['Pseudo'];
    include('../Model/Avis_Add.php');

    if($message=="OK"){
        echo "Message envoyée";

    }
    
    
}
?>
<Button onclick="history.back()"> Retour à l'Accueil</button>