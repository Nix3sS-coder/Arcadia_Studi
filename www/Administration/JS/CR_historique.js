function filter(){
            let animal=document.getElementById('pet-select').value
            let d1 =document.getElementById('firstdate').value
            let d2= document.getElementById('lastdate').value
            console.log(d1+"/"+d2)
            if(animal!=0){
                if(d1<d2){
                    console.log("Hey")
                    const apiUrl = 'PHP/Vue/detail_filter_CR_Vet.php';

                    // Données à envoyer dans la requête POST
                    const data = {
                        ID: animal,
                        D1: d1,
                        D2: d2
                    };

                    calltheAPI(apiUrl,data,"lstCR")


                    


                }else {
                    alert("La date de début doit être plus petite que la date de fin")
                }
            }else{
                alert("Merci de choisir un Animal")
            }
        }