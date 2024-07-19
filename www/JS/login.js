            function login(){
                var mail=document.getElementById('mail').value
                var pwd=document.getElementById('pwd').value
                if(mail!="" && pwd!=""){ 
                    if (mail.includes('.') && mail.includes('@')) {
                        document.location.href='Login_check.php?mail='+mail+'&pwd='+pwd
                    }else{
                        alert("Le mail doit être valide")
                    }
                }else{
                    alert('Les champs ne doivent pas être vide')
                }
            }
