// Fonction pour envoyer les données du formulaire à l'API
function sendDataToAPI(data,url) {

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
           const message = document.getElementById("contenu");
           alert(result.message);
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

// Fonction pour gérer la soumission du formulaire
function handleFormSubmission(e) {
    e.preventDefault(); // Empêcher la soumission par défaut du formulaire

    const formData = new FormData(e.target);
    const formDataObject = {};

    formData.forEach((value, key) => {
        formDataObject[key] = value;
    });
    const url = "caisse.php";
    sendDataToAPI(formDataObject,url);
}

function versement(e) {
    e.preventDefault(); // Empêcher la soumission par défaut du formulaire

    const formData = new FormData(e.target);
    const formDataObject = {};

    formData.forEach((value, key) => {
        formDataObject[key] = value;
    });
    const url = "fiche.php";
    sendDataToAPI(formDataObject,url);
}

document.getElementById('caisseFormulaire').addEventListener('submit', handleFormSubmission);
document.getElementById('virementform').addEventListener('submit', versement);
/***login*/
function load() {
    var body = document.getElementById("gg");
    body.style.opacity = "1";
    body.style.transition = "6s";
}
function over(id) {
    id.style = "width: 33%;transition: 0.5s;";
}

function out(id) {
    id.style = "width: 30%;transition: 0.5s;";
}

function showmodal() {
    document.getElementById('id01').style.display = 'block';
}

function hidemodal() {
    document.getElementById('id01').style.display = 'none';
}