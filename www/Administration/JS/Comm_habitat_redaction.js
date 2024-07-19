function sendcomm(){
                let habitat= document.getElementById('habitat-select').value
                let avis = document.getElementById('avis').value
                let etat=document.getElementById('etat').value
                let amelioration = document.getElementById('amelioration').checked

                if(habitat!=0){
                    if(avis!=""){
                        if(etat!=""){
                            const apiUrl = 'PHP/Model/Comm_habitat_Add.php';

                            // Données à envoyer dans la requête POST
                            const data = {
                                habitat: habitat,
                                avis: avis,
                                etat: etat,
                                amelioration:amelioration,
                            };

                            calltheAPI(apiUrl,data)

                        }else{
                            alert("Merci de renseigner un etat")
                        }
                    }else{
                        alert("Merci de renseigner un avis")
                    }
                }else{
                    alert("Merci de renseigner un habitat")
                }
            }