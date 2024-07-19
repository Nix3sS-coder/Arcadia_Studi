function uploadImage() {
    const imageInput = document.getElementById('imageInput');
    const file = imageInput.files[0];

    if (!file) {
        alert('Veuillez sélectionner une image.');
        return;
    }

    const formData = new FormData();
    formData.append('image', file);

    fetch('PHP/Controller/api.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.randomFileName) {
            document.getElementById('result').innerHTML = 
                'Nom de fichier aléatoire: ' + data.randomFileName + '<br>' +
                'Chemin du fichier: ' + data.filePath;

            var elt = `<img src="${data.filePath}" alt="Image" onclick="changeimg('${data.filePath}', '${data.ID}')">`;
            document.getElementById('lstimg').insertAdjacentHTML('beforeend', elt);
        } else {
            document.getElementById('result').textContent = 'Erreur: ' + data.error;
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        document.getElementById('result').textContent = 'Erreur lors de la requête.';
    });
}

function quittchooseimg() {
    document.getElementById('chooseimglst').style.display = "none";
}

function changeimg(imgPath, value) {

    let imgElement = document.getElementById(lastclickimg);
    // Trouver la position de "IMG"
    let pos = lastclickimg.indexOf("img");
    let suffixe = "";
    if (pos !== -1) {
        // Extraire la partie de la chaîne après "img"
        let suffixe= lastclickimg.substring(pos + 3); // +3 pour sauter "img"
        console.log("nv :" + value + 'img'+suffixe);
        // Mettre à jour l'ID de l'élément img avec la valeur et le suffixe
        imgElement.id = value + 'img'+suffixe;
        console.log(lastclickimg)
        let imgElement2 = document.getElementById(value + 'img'+suffixe);
        imgElement2.src = imgPath;
    }

    
    quittchooseimg();
}


