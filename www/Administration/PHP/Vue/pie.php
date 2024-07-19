<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagramme en Secteur</title>
    <style>
        .chart-container-pie {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
            /*position: relative;  Pour positionner l'étiquette absolue */
        }

        .chart-pie {
            width: 100%;
            height: auto;
        }

        .slice-pie {
            stroke: #fff;
            stroke-width: 2px;
            transition: transform 0.2s ease-in-out;
        }

        .slice-pie:hover {
            transform: scale(1.1); /* Zoom légèrement au survol */
        }

        .label {
            font-size: 12px;
            fill: #000;
            text-anchor: middle;
            opacity: 1; /* Masquer l'étiquette par défaut */
            transition: opacity 0.2s ease-in-out;
        }

        .slice-pie:hover + .label {
            opacity: 1; /* Afficher l'étiquette au survol */
        }

        .tooltip {
            position: absolute;
            display: none;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px; /* Augmenter la taille du tooltip */
            border: 1px solid #ccc;
            border-radius: 5px;
            pointer-events: none; /* Ne pas interférer avec les événements de la souris */
            font-size: 14px;
            max-width: 200px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Assurer que le tooltip est au-dessus des autres éléments */
        }
    </style>
</head>
<body>
    <div class="chart-container-pie">
        <h2>Diagramme en Secteur</h2>
        <!--<div>
            <label for="newDataLabel">Label:</label>
            <input type="text" id="newDataLabel">
            <label for="newDataValue">Valeur:</label>
            <input type="number" id="newDataValue">
            <button onclick="addData()">Ajouter</button>
            <label for="removeIndex">Supprimer à l'index:</label>
            <input type="number" id="removeIndex">
            <button onclick="removeData()">Supprimer</button>
        </div>-->
        <svg class="chart-pie" viewBox="0 0 400 400">
            <!-- Création des sections du diagramme -->
            <g class="slices">
                <!-- Ajoutez ici les sections du diagramme -->
            </g>
            <!-- Ajout des étiquettes -->
            <g class="labels">
                <!-- Ajoutez ici les étiquettes -->
            </g>
        </svg>
        <div class="tooltip" id="tooltip"></div>
    </div>

    <script>
        let datapie = <?php echo $data; ?>;

        const chartpie = document.querySelector('.chart-pie');
        const slicespie = chartpie.querySelector('.slices');
        const labelspie = chartpie.querySelector('.labels');
        const tooltippie = document.getElementById('tooltip');

        function drawChartpie() {
            slicespie.innerHTML = '';
            labelspie.innerHTML = '';

            const total = datapie.reduce((acc, d) => acc + parseInt(d.value), 0);
            let startAngle = -90; // Début à 270 degrés pour que le premier segment soit à midi

            datapie.forEach((d, i) => {
                const angle = 360 * (parseInt(d.value) / total);
                const endAngle = startAngle + angle;

                // Coordonnées pour le segment
                const startX = 200 + 150 * Math.cos(startAngle * Math.PI / 180);
                const startY = 200 + 150 * Math.sin(startAngle * Math.PI / 180);
                const endX = 200 + 150 * Math.cos(endAngle * Math.PI / 180);
                const endY = 200 + 150 * Math.sin(endAngle * Math.PI / 180);

                // Pour éviter les diagrammes à l'envers, ajuster les angles
                const largeArcFlag = angle <= 180 ? '0' : '1';

                // Création du chemin SVG pour le segment
                const dAttribute = `M 200 200 L ${startX} ${startY} A 150 150 0 ${largeArcFlag} 1 ${endX} ${endY} Z`;
                const slice = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                slice.setAttribute('d', dAttribute);
                slice.setAttribute('fill', `hsl(${i * 60}, 70%, 50%)`);
                slice.setAttribute('class', 'slice-pie');
                slice.setAttribute('data-label', d.label); // Ajout du label comme attribut de données
                slicespie.appendChild(slice);

                // Ajout du texte avec le pourcentage
                const labelX = 200 + 120 * Math.cos((startAngle + angle / 2) * Math.PI / 180);
                const labelY = 200 + 120 * Math.sin((startAngle + angle / 2) * Math.PI / 180);
                const percentageText = `${((parseInt(d.value) / total) * 100).toFixed(2)}%`;
                const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                label.setAttribute('x', labelX);
                label.setAttribute('y', labelY);
                label.setAttribute('class', 'label');
                label.textContent = percentageText;
                labelspie.appendChild(label);

                // Mettre à jour l'angle de départ pour le prochain segment
                startAngle = endAngle;
            });
        }

       // function addData() {
    //        const newLabel = document.getElementById('newDataLabel').value;
    //        const newValue = parseInt(document.getElementById('newDataValue').value);
    //        if (newLabel && !isNaN(newValue)) {
    //            datapie.push({ label: newLabel, value: newValue });
    //            drawChartpie();
    //        } else {
    //            alert("Veuillez entrer une étiquette et une valeur numérique valide.");
      //      }
      //  }

        //function removeData() {
        //    const indexToRemove = parseInt(document.getElementById//('removeIndex').value);
        //    if (!isNaN(indexToRemove) && indexToRemove >= 0 && indexToRemove < datapie.length) {
        //        data.splice(indexToRemove, 1);
        //        drawChartpie();
        //    } else {
        //        alert("Veuillez entrer un index valide.");
        //    }
        //}

        // Gestion du clic sur les segments
        slicespie.addEventListener('click', (event) => {
            if (event.target.classList.contains('slice-pie')) {
                const label = event.target.getAttribute('data-label');
                const { clientX, clientY } = event;

                tooltippie.style.left = `${clientX }px`; // Ajouter un décalage à droite
                tooltippie.style.top = `${clientY +60}px`; // Déplacer légèrement vers le haut
                tooltippie.textContent = label;
                tooltippie.style.display = 'block';

                // Cacher le tooltip après 5 secondes
                setTimeout(() => {
                    tooltippie.style.display = 'none';
                }, 5000); // 5 secondes de délai avant de masquer le tooltip
            }
        });

        drawChartpie();
    </script>
</body>
</html>
