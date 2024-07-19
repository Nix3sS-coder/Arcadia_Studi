        function addCR(){
            let animal =document.getElementById('pet-select').value
            let date =document.getElementById('date').value
            let Etat =document.getElementById('etat').value
            let nourriture =document.getElementById('nourriture').value
            let grammage =document.getElementById('grammage').value
            let Details =document.getElementById('Details').value
            if(animal!=0){
                if(date!=""){
                    if(Etat!=""){
                        if(nourriture!=""){
                            if(grammage!=""){
                                if(Details!=""){
                                    const apiUrl = 'PHP/Model/CR_add.php';

                                    // Données à envoyer dans la requête POST
                                    const data = {
                                        animal: animal,
                                        date: date,
                                        Etat: Etat,
                                        nourriture: nourriture,
                                        grammage: grammage,
                                        Details: Details
                                    };

                                    calltheAPI(apiUrl,data)

                                }else{
                                    alert("Merci de remplir un Details")
                                } 
                            }else{
                                alert("Merci de remplir un grammage")
                            } 
                        }else{
                            alert("Merci de remplir un nourriture")
                        } 
                    }else{
                        alert("Merci de remplir un Etat")
                    } 
                }else{
                    alert("Merci de choisir une date")
                }   
            }else{
                alert("Merci de choisir un animal")
            }

        }