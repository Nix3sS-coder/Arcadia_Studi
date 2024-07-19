function calltheAPI(apiUrl, data, htmlid = "") {
    const headers = {
        'Content-Type': 'application/json',
        'User-Agent': 'MyAppAPI'
    };

    fetch(apiUrl, {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (htmlid === "") {
            alert(data.message);
            setTimeout(() => {
                location.reload();
            }, 100);
        } else {
            console.log(htmlid);
            document.getElementById(htmlid).innerHTML = data.html;
        }
    })
    .catch(error => {
        console.error('Il y a eu un problème avec votre requête :', error);
    });
}
