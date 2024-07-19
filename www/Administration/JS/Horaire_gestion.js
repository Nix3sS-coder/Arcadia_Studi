 function getValues() {
            const rows = ['am1', 'am2', 'pm1', 'pm2'];
            const values = {};

            // Collecter les valeurs de chaque ligne
            rows.forEach(rowId => {
                const row = document.getElementById(rowId).parentNode;
                const inputs = row.getElementsByTagName('input');
                values[rowId] = [];

                for (let i = 0; i < inputs.length; i++) {
                    const inputValue = inputs[i].value;
                    // Vérifier que la valeur ne contient pas de '/'
                    if (inputValue.includes('/')) {
                        throw new Error(`Invalid value "${inputValue}" in ${rowId} at position ${i+1}`);
                    }
                    values[rowId].push(inputValue);
                }
            });

            return values;
        }

        function organizeValues(values) {
            const organizedValues = [];
            const numColumns = values['am1'].length;

            // Initialiser les listes vides pour chaque colonne
            for (let i = 0; i < numColumns; i++) {
                organizedValues[i] = [];
            }

            // Parcourir chaque ligne et organiser les valeurs par colonne
            Object.keys(values).forEach(rowId => {
                values[rowId].forEach((value, index) => {
                    organizedValues[index].push(value);
                });
            });

                        // Transformer chaque liste en chaîne de caractères séparée par '/'
                        const organizedStrings = organizedValues.map(columnValues => columnValues.join('/'));


            return organizedStrings;
        }


        function modif(){
            const valeur = organizeValues(getValues())
            const data = {
                        lun: valeur[0],
                        mar: valeur[1],
                        merc: valeur[2],
                        jeu: valeur[3],
                        ven: valeur[4],
                        sam : valeur[5],
                        dim : valeur[6]
                    };
            
            const apiUrl = 'PHP/Model/modif_horaire.php';
            calltheAPI(apiUrl,data);
        }