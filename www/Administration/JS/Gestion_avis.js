                function changeValidate(id){
                    const apiUrl = 'PHP/Model/Avis_Change_Validate.php';
                    let checked=document.getElementById('check'+id).checked
                    if(checked==false){
                        validation=0
                    }else{
                        validation=1
                    }
                    // Données à envoyer dans la requête POST
                    const data = {
                        id: id,
                        validation:validation
                    };

                    calltheAPI(apiUrl,data)
                }

                function SupprimerAvis(id){
                    if(confirm("Voulez vous vraiment supprimer cet avis?")){
                        const apiUrl = 'PHP/Model/Avis_delete.php';
                        const data = {
                        id: id,
                    };

                    calltheAPI(apiUrl,data)
                    }
                }