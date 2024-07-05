document.getElementById('sub').onclick = function request() {
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var matricule = document.getElementById('matricule').value;
    var fonct = document.getElementById('fonction').value;

    var codeS = document.getElementById('codeS').value;
    var dateN = document.getElementById('dateN').value;
    var dateR = document.getElementById('dateR').value;
    var numero = document.getElementById('numero').value;
    var email = document.getElementById('email').value;
    var direction = document.getElementById('direction').value;

    alert("email : "+email)

    if (nom === "" || prenom === "" || matricule === "" || codeS === "" || dateN === "" || dateR === "" || numero === "" || email === "") {
        alert('Veuillez remplir toutes les informations');
        return;
    }
    var link = "http://localhost/PFEnous/php/requests.php";

    var formData = new FormData();
    formData.append('nom', nom);
    formData.append('prenom', prenom);
    formData.append('matricule', matricule);
    formData.append('codeS', codeS);
    formData.append('dateN', dateN);
    formData.append('dateR', dateR);
    formData.append('numero', numero);
    formData.append('fonction', fonct);
    formData.append('email', email);
    formData.append('direction', direction);


    fetch(link, {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('La requête a échoué.');
        }
        return response.text();
    })
    .then(data => {
        alert('Add success');
        document.getElementById('nom').value = "";
        document.getElementById('prenom').value = "";
        document.getElementById('matricule').value = "";
        document.getElementById('codeS').value = "";
        document.getElementById('dateN').value = "";
        document.getElementById('dateR').value = "";
        document.getElementById('numero').value = "";
        document.getElementById('fonction').value = "";
        document.getElementById('email').value = "";
        document.getElementById('direction').value = "";

    })
    .catch(error => {
        console.error('Erreur lors de la requête :', error);
    });
};
