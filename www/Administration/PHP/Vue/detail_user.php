<?php

include("PHP/Model/recup_users.php");
foreach($users as $user){
    if($user['role']!=1){ 

        
    echo "<div class=\"bgelt\" id='".$user['ID']."'>";
    echo "<button onclick=\"modif(".$user['ID'].")\">Modifier</button>";
    echo "<button onclick=\"supp(".$user['ID'].")\">Supprimer</button>";
    if($user['role']==2){
            echo "<h4>Veterinaire</h4>";
    }else{
            echo "<h4>Employee</h4>";
    }

    echo "<p>".$user['mail']."</p>";
    echo "<input id='value".$user['ID']."' value='".$user['pwd']."'>";

    echo "</div>";



    }
    
    
    


}
?>