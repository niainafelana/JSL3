
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap2/w3.css">
  <link rel="stylesheet" href="font/css/font-awesome.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/jquery/jquery.min.js"></script>
  <title>Accueil</title>
  <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
 <div id="ok">
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="caisse" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Caisse
</button> <br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="virement" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Virement
</button> <br>
<!-- Button tsotra -->
<a href="transfert.html"><button type="button" id="transfert" class="btn btn-secondary btn-lg">Transfert</button></a><br> 
 </div>


<!-- Modal -->
        <section>
        <form  id="caisseFormulaire">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div id="titree" class="modal-header">
              <i class="fa fa-home" id="hommee" class="logo-medias"></i>
                <h5 class="modal-title" id="exampleModalLabel">CAISSE</h5>
                <i class="fa fa-close" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></i>
              </div>
              <div class="modal-body">
              <input class="w3-input w3-border" id="nif" name="nif" type="number" onblur="recherche(this)" placeholder="NIF" name="nif"  required> <br>
              <input class="w3-input w3-border" id="nom" name="nom" type="text" placeholder="Raison sociale"readonly> <br>
              <input class="w3-input w3-border" id="adr"  type="text" placeholder="Adresse" name="adr" readonly> <br>
              <input class="w3-input w3-border" type="number" placeholder="montant" id="montant" name="montant" required> <br>
              <select class="w3-select w3-border" id="mode" name="mode" required>
                    <option value="" disabled selected>Mode de règlement</option> 
                    <option value="Espèce">Espèce</option>
                    <option value="Chèque">Chèque</option> 
              </select><br> <br>
              </div>
              <div class="modal-footer">
              <button class="w3-button w3-blue w3-round-xxlarge" type="submit" name="ajout"  id="ajoutcaisse"> Payer</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        </section>

<!-- virement -->
<form id="virementform">
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div id="bcm" class="modal-header">
                          <h3 class="modal-title" id="staticBackdropLabel">Virement</h3>
                          <i class="fa fa-close" id="closee" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></i>
                        </div>
                        <div class="modal-body">
                        <input class="w3-input w3-border" id="nif" name="nif" type="number" onblur="recherche(this)" placeholder="NIF" name="nif"  required> <br>
                        <input class="w3-input w3-border" id="nom" name="nom" type="text" placeholder="Raison sociale"readonly> <br>
                    
                  <!-- banque --><div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Banque</label>
                    <select class="form-select"  name="banque" id="banque inputGroupSelect01">
                      <option selected>Choisir</option>
                      <option value="BOA">BOA</option>
                      <option value="BNI">BNI</option>
                      <option value="BFV">BFV</option>
                    </select>
                  </div>
                  <!-- reference --><div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Reference bancaire</span>
                    <input type="text" id="ref" name="ref" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <!-- montant --><div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Montant</span>
                    <input type="number" id="montant" name="montant" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <!-- valeur--><div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Date de valeur</span>
                    <input type="date" id="date1" name="date1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <!-- mode de reglement--><div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Mode de reglement</label>
                    <select class="form-select" name="mode" id=" mode inputGroupSelect01">
                      <option selected>Choisir</option>
                      <option value="virement">Virement</option>
                    </select>
                  </div>
                  <!-- datereglement --><div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Date de reglement</span>
                    <input type="date" id="date2" name="date2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Payer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
<section id="titre">

  <h4>Service Regional des Entreprises</h4>
 
<img id="photo" src="assets/sary/accueil.jpg" alt="">
</section>



              <!-- Toast -->
              <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
                <div id="live" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <strong id="titre" class="me-auto"> Message </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div id="contenu" class="toast-body">
                    
                  </div>
                </div>
              </div>

<script>
    function recherche(input) {
      const matriculeInput = input;
      const nomInput = matriculeInput.parentElement.querySelector('#nom');
      const adresseInput = matriculeInput.parentElement.querySelector('#adr');

      const nif = matriculeInput.value;

      if (nif.trim() !== '') {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            nomInput.value = data.raison;
            adresseInput.value = data.adrs;
          }
        };
        xhr.open('POST', 'get.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('nif=' + encodeURIComponent(nif));
      }
    }
  </script>
  <script src="js/main.js"></script>
</body>
</html>