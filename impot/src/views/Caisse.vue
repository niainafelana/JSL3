<script setup>
import Sidebar from '../components/Sidebar.vue';
import { ref } from 'vue';
import Swal from 'sweetalert2'

const result = ref('');
const adresse = ref('');
const errorMessage = ref('');
const error = ref('');

const searchData = async () => {
  try {
    const nifValue = nif.value; // Assurez-vous que la valeur de nif est correctement récupérée
    const response = await fetch(`http://localhost:3000/data?nif=${nifValue}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error('Erreur');
    }

    const data = await response.json();

    if (data.length > 0) {
      result.value = data[0].raison;
      adresse.value = data[0].adrs;
    } else {
      result.value = '';
      adresse.value = '';
      error.value = 'Aucun résultat trouvé pour le NIF spécifié';
      errorMessage.value = '';
    }
  } catch (error) {
    console.error('Error fetching data:', error);
    error.value = '';
    errorMessage.value = 'Erreur lors de la recherche des données';
  }
};

const nif = ref('');
const mode = ref('');
const montant = ref('');
const valiny = ref('');

const validateNif = (event) => {
  let input = event.target.value;
  // Supprimer tous les caractères non numériques
  input = input.replace(/\D/g, '');
  // Limiter la longueur à 12 caractères
  if (input.length > 12) {
    input = input.slice(0, 12);
  }
  nif.value = input;
};

const submitForm = () => {
  fetch('http://localhost:3000/paiement', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      nif: nif.value,
      mode: mode.value,
      montant: montant.value
    })
  })
    .then(response => {
      if (response.ok) {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Paiement Ajouter",
          showConfirmButton: false,
          timer: 1500
        });
        nif.value = '';
        montant.value = '';
        mode.value = '';
        adresse.value = '';
        result.value = '';
      } else {
        valiny.value = 'diso';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      valiny.value = 'Erreur interne du serveur';
    });
};
</script>

<template>
  <Sidebar />
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-5">
        <div class="image">
          <img src="../assets/image/mudey-online.webp" alt="" class="img-fluid">
        </div>
      </div>
      <div class="contenu col-md-6">
        <div class="card">
          <h5>CAISSE</h5>
          <div class="row">
            <form>
              <div class="form-group mb-1">
                <label for="nifInput">NIF</label>
                <input type="text" v-model="nif" @input="validateNif" @keyup.enter="searchData()" class="form-control"
                  placeholder="Entrer le NIF" id="nifInput">
                <small id="emailHelp" class="form-text text-muted"></small>
              </div>

              <div class="form-group mb-1">
                <label for="raisonInput">Raison Sociale</label>
                <input type="text" v-model="result" class="form-control" placeholder="Raison sociale" id="raisonInput">
              </div>

              <div class="form-group mb-1">
                <label for="adresseInput">Adresse</label>
                <input type="text" v-model="adresse" class="form-control" placeholder="Adresse" id="adresseInput">
              </div>

              <div v-if="errorMessage">{{ errorMessage }}</div>
              <div v-if="error">{{ error }}</div>

              <div class="form-group mb-1">
                <label for="montantInput">Montant</label>
                <input v-model="montant" type="text" class="form-control" placeholder="Montant" id="montantInput">
              </div>

              <div class="form-group mb-1">
                <label for="modeInput">Mode de règlement</label>
                <select class="w3-select w3-border" v-model="mode" id="modeInput" required>
                  <option value="" disabled selected>Mode de règlement</option>
                  <option value="Espèce">Espèce</option>
                  <option value="Chèque">Chèque</option>
                </select>
              </div>

              <button @click="submitForm" type="button" class="btn btn-primary">Submit</button>
              <p v-if="message">{{ message }}</p>
              <p v-if="valiny">{{ valiny }}</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.image {
  width: 70%;
  border-radius: 20%;
  float: right;
  margin-top: 25%;
}

.contenu {
  float: right;
  margin-left: 8%;
}

.row {
  margin-left: 5%;
}

.card {
  top: 60%;
  left: 40%;
  width: 435px;
  padding: 31px 40px;
  transform: translate(-50%, -50%);
  border: 1px solid black;
}
</style>
