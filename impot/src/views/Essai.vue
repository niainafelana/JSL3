<template>
  <div>
    <h1>Recherche de contribuable</h1>
    <input type="text" v-model="nif" placeholder="Entrez le NIF" @keyup.enter="searchContribuable">
    <div v-if="contribuable">
      <p><strong>Nom:</strong> {{ contribuable.raison }}</p>
      <p><strong>Adresse:</strong> {{ contribuable.adrs }}</p>
    </div>
    <div v-if="error">{{ error }}</div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const nif = ref('');
const contribuable = ref(null);
const error = ref('');

const searchContribuable = async () => {
  try {
    const response = await fetch('http://localhost:3000/data', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ nif: nif.value })
    });
    if (!response.ok) {
      throw new Error('Erreur lors de la recherche des données');
    }
    const data = await response.json();
    if (data.length > 0) {
      contribuable.value = data[0];
      error.value = '';
    } else {
      error.value = 'Aucun contribuable trouvé pour ce NIF';
      contribuable.value = null;
    }
  } catch (error) {
    console.error(error);
    error.value = 'Erreur lors de la recherche des données';
    contribuable.value = null;
  }
}
</script>

<style>
/* Ajoutez vos styles CSS ici */
</style>
