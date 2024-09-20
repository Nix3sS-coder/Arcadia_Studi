<?php

include('PHP/Model/Service_recup_infos.php');
if(!empty($services)){


foreach($services as $serv){
    echo '<article class="bgelt">';
    echo '<div>';
        echo '<p>Nom du service</p>';
        echo '<input id="Nom'.$serv['ID'].'" value="'.$serv['Nom'].'"></input>';
    echo '</div>';

    echo '<div>';
    echo '<p>Description du service</p>';
    echo '<textarea id="Desc'.$serv['ID'].'" value="'.$serv['Description'].'">'.$serv['Description'].'</textarea>';
    echo '</div>';

    echo '<button onclick="modifserv('.$serv['ID'].')">Modifier</button>';
    echo '<button onclick="suppserv('.$serv['ID'].')">Supprimer</button>';
    echo '</article>';
}

}else{
    echo 'Aucun service disponible';
}
?>