function contact(){
                var title=document.getElementById('Titre').value
                var desc=document.getElementById('Description').value
                var mail=document.getElementById('Mail').value
                if(title!="" && desc!="" && mail!=""){ 
                    if (mail.includes('.') && mail.includes('@')) {
                        document.location.href='PHP/Vue/Contact_mail.php?title='+title+'&desc='+desc+"&mail="+mail
                    }else{
                        alert("Le mail doit être valide")
                    }
                }else{
                    alert('Les champs ne doivent pas être vide')
                }
            }

            function avis(){
                var AvisUser=document.getElementById('AvisUser').value
                var Pseudo=document.getElementById('Pseudo').value
                if(AvisUser!="" && Pseudo!=""){
                    document.location.href='PHP/Vue/Contact_Avis.php?Avis='+AvisUser+'&Pseudo='+Pseudo
                }else{
                    alert('Les champs ne doivent pas être vide')
                }
            }