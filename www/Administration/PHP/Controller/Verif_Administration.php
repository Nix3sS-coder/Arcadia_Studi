<?php
    include('../PHP/Controller/Verification_Cookie.php');
        $session="";
        $user_data = read_secure_cookie('user_data');

        function check($role1,$role2=0,$role3=0){
            global $user_data;
            if ($user_data) {
                if($user_data['role']==$role1 || 
                ($user_data['role']==$role2 && $user_data['role']!=0)
                || ($user_data['role']==$role3 && $user_data['role']!=0)){
                    $session="OK";
                    //echo "OK";
    
    
                }else{
                    echo 'Non autorisée';
                    header('Location: ../login.php');
                }
    
            } else {
                echo 'Cookie invalide ou falsifié.';
                header('Location: ../login.php');
            }
    

        }

