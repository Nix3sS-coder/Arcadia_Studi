var lastclickimg = "";
        var compteurnew = 0;


        function checkforchange(id, valide) {
            lastclickimg = id;
            document.getElementById('chooseimglst').style.display = "block";
            if (valide == 0) {
                document.getElementById('existchooseimg').style.display = "none";
            } else {
                document.getElementById('existchooseimg').style.display = "block";
            }
        }

        function removeimg(id) {
            document.getElementById(id).remove();
        }

        function addimg(hab) {
            var elt = `<div class='imgrmv' id='img`+compteurnew+`'>
                    <img id="img`+hab+compteurnew+`" src="UNKNOW.PNG" onclick="checkforchange('img`+compteurnew+`', 0)">
                    <button onclick='removeimg("img`+compteurnew+`")'>-</button>
                </div>`;
            document.getElementById('lstimg' + hab).insertAdjacentHTML('beforeend', elt);
            checkforchange('img' + hab + compteurnew, 0);
            compteurnew++;
            lastclickimg=img+compteurnew
        }

        function add(id) {

            let nom = document.getElementById('nom' + id).value;
            let race = document.getElementById('race' + id).value;
            let hab = document.getElementById('selecthabitat' + id).value;
            let imglst = document.querySelectorAll('#lstimg' + id + ' img');

            if(nom!=""){
                if(race!=""){
                    if(hab!=""){
                        let listimg = "";
                        // Parcourir et afficher les images sélectionnées
                        imglst.forEach(function(image) {

                            // Chaîne de texte contenant la valeur à récupérer
                            var texte = image.id;

                            // Expression régulière pour rechercher le motif "150img15"
                            var regex = /(\d+)img(\d+)/;

                            // Utilisation de match() pour obtenir les correspondances
                            var matches = texte.match(regex);

                            // Si des correspondances sont trouvées, afficher la valeur avant "150img15"
                            console.log("Value : "+matches[1])

                            listimg += matches[1] + "/"; // Concatène le chemin propre avec un '/'
                            console.log(matches[1] + "/"); // Affiche chaque chemin propre suivi d'un '/'

                        });


                        listimg = listimg.slice(0, -1); // Supprime le dernier '/'

                        if(listimg!=""){
                            console.log(listimg); // Affiche la liste des chemins d'images propres, sans le dernier '/'
                            const apiUrl = 'PHP/Model/add_animal.php';

                            // Données à envoyer dans la requête POST
                            const data = {
                                nom: nom,
                                race: race,
                                hab:hab,
                                imglst: listimg,
                            };


                            calltheAPI(apiUrl,data);
                        }else{
                            alert("Merci de renseigner une image")
                        }
                    }else{
                            alert("Merci de renseigner un habitat")
                        }
                }else{
                            alert("Merci de renseigner une race")
                        }
            }else{
                            alert("Merci de renseigner un Prenom")
                        }

        }
