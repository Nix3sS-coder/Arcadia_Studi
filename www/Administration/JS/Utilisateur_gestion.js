           function modif(id){
                var pwd=document.getElementById('value'+id).value
                if(pwd!=""){
                                                // URL de l'API PHP
                    const apiUrl = 'PHP/Model/modif_user.php';

                    // Données à envoyer dans la requête POST
                    const data = {
                        pwd: pwd,
                        id: id
                    };

                    calltheAPI(apiUrl,data);
                }
            }

            function supp(id){
                if(confirm("Voulez vous vraiment supprimer le compte ?")){
                    const apiUrl = 'PHP/Model/supp_user.php';

                    // Données à envoyer dans la requête POST
                    const data = {
                        id: id
                    };

                    calltheAPI(apiUrl,data);
                }
            }