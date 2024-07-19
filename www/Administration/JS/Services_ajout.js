                function addserv(){
                let Nom=document.getElementById('Nom').value
                let Desc=document.getElementById('Desc').value
                if(Nom!=""){
                    if(Desc!=""){
                        
                        const apiUrl = 'PHP/Model/Services_add.php';
                        const data = {
                            Nom:Nom,
                            Desc : Desc
                        };

                        calltheAPI(apiUrl,data)
                    }else{
                        alert('Merci de Renseigner une Description')
                    }
                }else{
                    alert('Merci de Renseigner un Nom')
                }
            }