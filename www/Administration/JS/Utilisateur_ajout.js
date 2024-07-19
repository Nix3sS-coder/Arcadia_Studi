function createAccount(){
            let role =document.getElementById('role-select').value
            let mail =document.getElementById('mail').value
            let pwd =document.getElementById('PWD').value

            if(role=="2" || role=="3"){
                if(mail.includes('@') && mail.includes('.')){
                    if(pwd!=""){

                        const apiUrl = 'PHP/Model/add_user.php';

                        // Données à envoyer dans la requête POST
                        const data = {
                            role:role,
                            mail:mail,
                            pwd:pwd,
                        };

                        calltheAPI(apiUrl,data)
                    }else{
                        alert("Merci de renseigner un mot de passe")
                    }
                }else{
                    alert("Merci de choisir un mail Valide")
                }
            }else{
                alert("Merci de choisir un role valide")
            }
        }