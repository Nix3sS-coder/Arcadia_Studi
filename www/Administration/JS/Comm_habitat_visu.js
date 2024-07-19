           function commHabFilter(){
                let habitat= document.getElementById('habitat-select').value
                let ameliorable = document.getElementById('ameliorable').checked

                if(habitat!=0){
                    const apiUrl = 'PHP/Vue/Comm_detail_filter.php';
                    // Données à envoyer dans la requête POST
                    const data = {
                        habitat: habitat,
                        amelioration:ameliorable,
                    };

                            calltheAPI(apiUrl,data,"lstcomm")

                }else{
                    alert("Merci de renseigner un habitat")
                }
            }