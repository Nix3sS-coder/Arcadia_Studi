            function menu(nb){
                Listinf=[1 , 20 , 39 ,58,78]
                Listsup=[9,27,45,63,82]
                largeur = window.innerWidth;
                valeur=0
                if (largeur > 780) {
                    valeur=Listsup[nb-1]
                    
                    document.getElementById("nav"+nb).style.marginBottom= "4VW"
                }else{
                    valeur=Listinf[nb-1]
                    
                    document.getElementById("nav"+nb).style.marginBottom= "6VW"
                }

            document.getElementById("bulle").style.marginLeft = valeur+"VW"

        }