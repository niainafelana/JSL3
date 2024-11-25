<script setup>
import Sidebar from '../components/Sidebar.vue'
import { ref } from 'vue';

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
}


const nif = ref('');
const fer = ref('');
const banky = ref('');
const vola = ref('');
const date1 = ref('');
const date2 = ref('');
const valiny = ref('');
const formatDate = (dateString) => {
  const [day, month, year] = dateString.split('/');
  return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
};
const virementform = () => {
     
  const formattedDate1 = formatDate(date1.value);
  const formattedDate2 = formatDate(date2.value);

  fetch('http://localhost:3000/virement', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      ref:fer.value,
      nif: nif.value,
      raison:result.value,
      banque:banky.value,
      montant: vola.value,
      date1: formattedDate1,
      date2: formattedDate2
    })
  })
    .then(response => {
      if (response.ok) {
        valiny.value='erreur';
        alert('Paiement ajouter');
        nif.value = '';
        fer.value = '';
        vola.value = '';
        date1.value = '';
        date2.value = '';
        banky.value = '';
        adresse.value = '';
        result.value = '';
    
      }
      else{
        valiny.value = 'diso';
        alert('GFHGFHFGFFG');
      }
      
    })
    .catch(error => {
      console.error('Error:', error);
      valiny.value = 'Erreur interne du serveur';
    });
};

</script>
<template>
     <Sidebar/>
<div class=" container-fluid">
    <div class="row">
    

        <div class="contenu col-md-6">
            <div class="card">
                <h5>VIREMENT</h5>
                <div class="row">
                    <form>

    <div class="raw">
      <div class= "form-group mb-1">
    <label for="exampleInputEmail1">NIF</label>
    <input type="number" v-model="nif" @keyup.enter="searchData()" class="form-control" placeholder="Entrer le NIF" @blur="essai()">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>

  <div class= "form-group mb-1">
    <label for="exampleInputEmail1">Raison Sociale</label>
    <input type="text" v-model="result" class="form-control" placeholder="Raison sociale">
  </div>
    </div>
  
<div class="rew">
  <div class= "form-group mb-1">
    <label for="exampleInputEmail1">Adresse</label>
    <input type="text" v-model="adresse" class="form-control" placeholder="Adresse">
  </div>
  <div v-if="errorMessage">{{ errorMessage }}</div>
  <div v-if="error">{{ error }}</div>
  <div class= "form-group mb-1">
    <label for="exampleInputEmail1">Montant</label>
    <input v-model="vola" type="text" class="form-control" placeholder="Montant">
  </div>
 
</div>
  
<div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Banque</label>
                    <select class="form-select" v-model="banky" name="banque" id="banque inputGroupSelect01">
                      <option selected>Choisir</option>
                      <option value="BOA">BOA</option>
                      <option value="BNI">BNI</option>
                      <option value="BFV">BFV</option>
                    </select>
  </div>
  <div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Reference bancaire</span>
                    <input type="text" v-model="fer" id="ref" name="ref" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
  </div>                

 

  <div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Date de valeur</span>
                    <input type="date" v-model="date1" id="date1" name="date1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <!-- datereglement --><div class="input-group input-group-sm mb-3">
                  <span class="input-group-text"  id="inputGroup-sizing-sm">Date de reglement</span>
                    <input type="date"  v-model="date2" id="date2" name="date2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
  
  
  <button type="button" @click="virementform" class="btn btn-primary">Submit</button>
  <p v-if="valiny">{{ valiny }}</p>
</form>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
        <div class="image">
            <img src="../assets/image/mudey-online.webp" alt="" class="img-fluid">
        </div>
        </div>
    </div>
</div>
</template>
<style scoped>
.image{
  width: 70%;
  margin-top: -85%;
  border-radius: 20%;
  float: right;
}
.contenu{
    float: left;
    margin-top: -55%;
    padding-left: 40%;
}
.card{
    top: 60%;
    left: 40%;
    width: 430px;
    padding: 5px 20px;
    transform: translate(-50%,-50%);
    border: 1px solid black;
}
.raw{
  display: flex;
  gap: 10px;
}
.rew{
  display: flex;
  gap: 5px;
}
</style>