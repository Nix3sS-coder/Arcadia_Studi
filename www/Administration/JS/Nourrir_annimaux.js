function choixanimal(){
                let animal =document.getElementById('pet-select').value
                if(animal!=0){
                    const apiUrl = 'PHP/Vue/Nourriture_recup_CR.php';

                    // Données à envoyer dans la requête POST
                    const data = {
                        animal: animal,
                    };

                    calltheAPI(apiUrl,data,"recapveto")
                    document.getElementById('Nourrir').style.display="flex"
                    document.getElementById('choixAnimal').style.display="none"

                }else{
                    alert("Merci de choisir un animal")
                }
            }


            function nourrirAnimal(){
                let animal =document.getElementById('pet-select').value
                let date =document.getElementById('date').value
                let hour =document.getElementById('hour').value
                let grammage =document.getElementById('grammage').value
                let nourriture =document.getElementById('nourriture').value
                if(date!=""){
                    if(hour!=""){
                        if(grammage!=""){
                            if(nourriture!=""){
                                const apiUrl = 'PHP/Model/Nourriture_add.php';

                                // Données à envoyer dans la requête POST
                                const data = {
                                    animal: animal,
                                    date : date,
                                    hour : hour,
                                    grammage : grammage,
                                    nourriture : nourriture
                                };
                                calltheAPI(apiUrl,data)

                                }else{
                                    alert("Merci de renseigner une nourriture")
                                }
                        }else{
                            alert("Merci de renseigner un grammage")
                        }
                    }else{
                        alert("Merci de renseigner une heur")
                    }
                }else{
                    alert("Merci de renseigner une date")
                }
            }