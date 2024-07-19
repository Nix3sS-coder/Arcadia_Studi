function suppserv(id){
            if(confirm("Voulez vous vraiment supprimer cet Element ?")){
                const apiUrl = 'PHP/Model/Services_delete.php';
                const data = {
                    id: id,
                };

                calltheAPI(apiUrl,data)
            }
        }
        function modifserv(id){
                let Nom=document.getElementById('Nom'+id).value
                let Desc=document.getElementById('Desc'+id).value
                if(Nom!=""){
                    if(Desc!=""){
                        
                        const apiUrl = 'PHP/Model/Services_Modif.php';
                        const data = {
                            id: id,
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