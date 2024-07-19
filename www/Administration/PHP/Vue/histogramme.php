<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histogramme</title>
    <style>
        .chart-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .chart {
            border: 1px solid #ccc;
           /* position: relative;*/
        }

        .bar {
            fill: steelblue;
        }

        .bar text {
            font-size: 10px;
            text-anchor: middle;
            fill: #fff;
        }

        .bar-value {
            font-size: 10px;
            text-anchor: middle;
            fill: black;
            visibility: hidden; /* Masquer par défaut */
        }

        .axis {
            stroke: #000;
            stroke-width: 1;
        }

        .tick {
            stroke: #000;
            stroke-width: 1;
        }

        .tick text {
            font-size: 10px;
        }
        .tooltip {
            position: absolute;
            display: none;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <h2>Histogramme</h2>
        <svg class="chart" viewBox="0 0 400 320">
            <!-- Axe des abscisses (X) -->
            <line class="axis x-axis" x1="50" y1="305" x2="50" y2="305" />
            <!-- Axe des ordonnées (Y) -->
            <line class="axis" x1="50" y1="300" x2="50" y2="20" />
            <!-- Marques sur les axes -->
            <g class="x-ticks">
                <!-- Ajoutez ici les marques sur l'axe X si nécessaire -->
            </g>
            <g class="y-ticks">
                <!-- Ajoutez ici les marques sur l'axe Y si nécessaire -->
            </g>
            <!-- Barres -->
            <g class="bars">
                <!-- Ajoutez ici les barres -->
            </g>
        </svg>
    </div>

    <script>
        const minValueY = 0; // Valeur minimale de l'axe Y
        let maxY;

        function drawChart(data) {
    const chart = document.querySelector('.chart');
    const xTicks = chart.querySelector('.x-ticks');
    const yTicks = chart.querySelector('.y-ticks');
    const bars = chart.querySelector('.bars');
    const tooltip = document.createElement('div');
    tooltip.classList.add('tooltip');
    document.body.appendChild(tooltip);

    // Effacer le contenu existant
    xTicks.innerHTML = '';
    yTicks.innerHTML = '';
    bars.innerHTML = '';

    // Convertir la chaîne JSON en objet JavaScript
    data = JSON.parse(data);

    // Calculer maxY
    maxY = Math.max(...data.map(item => parseFloat(item.value)));

    // Dessiner les marques sur l'axe des abscisses (X) et les barres
    data.forEach((item, index) => {
        const x = 70 + index * 70;

        const tick = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        tick.setAttribute('class', 'tick');
        tick.setAttribute('x1', x + 20);
        tick.setAttribute('y1', 300);
        tick.setAttribute('x2', x + 20);
        tick.setAttribute('y2', 305);
        xTicks.appendChild(tick);

        const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', x + 20);
        text.setAttribute('y', 320);
        text.textContent = item.label;
        text.style.visibility = 'hidden'; // Masquer le texte par défaut
        text.classList.add('bar-label'); // Ajouter une classe pour les étiquettes de barre
        xTicks.appendChild(text);

        // Vérifier si item.value est un nombre avant d'appeler toFixed
        const valueAsNumber = parseFloat(item.value);
        if (!isNaN(valueAsNumber)) {
            const barHeight = (valueAsNumber - minValueY) * (280 / maxY);
            const y = 300 - barHeight;

            const bar = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
            bar.setAttribute('class', 'bar');
            bar.setAttribute('x', x);
            bar.setAttribute('y', y);
            bar.setAttribute('width', 40);
            bar.setAttribute('height', barHeight);
            bar.setAttribute('data-animal', item.label); // Ajouter l'attribut data avec le nom de l'animal
            bars.appendChild(bar);

            // Ajouter l'événement mouseover pour afficher le tooltip
            bar.addEventListener('mouseover', function(event) {
                const mouseX = event.pageX;
                const mouseY = event.pageY;
                tooltip.style.left = mouseX + 'px';
                tooltip.style.top = mouseY + 'px';
                tooltip.textContent = item.label;
                tooltip.style.display = 'block';
            });

            // Ajouter l'événement mouseout pour masquer le tooltip
            bar.addEventListener('mouseout', function() {
                tooltip.style.display = 'none';
            });
        } else {
            console.error(`La valeur pour l'élément ${item.label} n'est pas un nombre valide.`);
        }
    });

    // Dessiner les marques sur l'axe des ordonnées (Y)
    const yRange = maxY - minValueY; // Plage de données sur l'axe Y
    const b = 10; // Nombre de segments
    const yStep = yRange / b; // Taille de chaque segment

    for (let i = 0; i <= b; i++) {
        const y = 300 - (i * (280 / b));
        const tick = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        tick.setAttribute('class', 'tick');
        tick.setAttribute('x1', 45);
        tick.setAttribute('y1', y);
        tick.setAttribute('x2', 50);
        tick.setAttribute('y2', y);
        yTicks.appendChild(tick);

        const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', 20);
        text.setAttribute('y', y + 5);
        text.textContent = (minValueY + (i * yStep)).toFixed(1); // Formater à une décimale près
        yTicks.appendChild(text);
    }

    // Ajuster la taille de la zone de tracé SVG
    const numBars = data.length;
    const svgWidth = 70 + numBars * 70;
    const chartWidth = svgWidth + 50 + 50; // 50 est la marge ajoutée pour l'axe des abscisses, ajouter 50 de marge à droite
    chart.setAttribute('viewBox', `0 0 ${chartWidth} 320`);

    // Ajuster la longueur du trait de l'axe des abscisses (X)
    const xAxis = chart.querySelector('.x-axis');
    xAxis.setAttribute('x2', chartWidth);
}

        let data = <?php echo json_encode($data); ?>;

        drawChart(data);
    </script>
</body>
</html>
