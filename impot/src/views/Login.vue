
<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';



const router = useRouter();
const username = ref('');
const password = ref('');
const errorMessage = ref('');

const login = async () => {
  try {
    const response = await axios.post('http://localhost:3000/login', {
      username: username.value,
      password: password.value
    });
    console.log(response.data.message);
    //errorMessage.value = 'marina'
    //alert('connecte')
    router.push('/dash')
    // Redirection ou autres actions après une connexion réussie
  } catch (error) {
    if (error.response && error.response.status === 401) {
      errorMessage.value = 'Invalid';

    } else if (error.response && error.response.status === 404) {
      errorMessage.value = 'User not found';
    } else {
      errorMessage.value = 'An error occurred. Please try again later.';
    }
    console.error(error);
  }
};

/*const router = useRouter();
const nom = ref('')
const mdp = ref('')
 const login = async () =>{
  const response = await axios.post('http://localhost:3000/login', {
          username: nom.value,
          password: mdp.value
  });
  const data = response.data
  console.log(data)
  if(data === 'ok')
  {
    alert('connecte')
    router.push('/accueil')
  }
  
  //alert(nom.value)
 }*/
</script>
<template id="teple">
  <div id="login" class="text-center" >
   <span>
     <p><img src="../assets/image/impot.jpg" alt=""></p>
   </span> 
   <form form class="w3-container">
    <div class="w3-section">
      <label><b>Username:</b></label>
      <input class="w3-input w3-border" type="text" placeholder="Enter Username" v-model="username" required><br><br>
  <label><b>Password:</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" v-model="password" required><br><br>
    <button  class="btn btn-info" type="button" @click="login">Login</button> 
    <p v-if="errorMessage">{{errorMessage}}</p>
    </div>
  </form>
  </div>
  </template>
<style scoped>
#teple{
  padding: 0%;
  margin: 0%;
}
button{
    width: 25%;
    padding: 09px;
    border-radius: 5px;
    border: none;
    margin-left: 3%;
    font-family: "Times New Roman", Times, serif;
    font-weight: bold;
 }

img{
  height: 50%;
  width: 30%;
  border-radius: 50%;
}
#login{
  margin: 30%;
  padding: 2%;
  background-color:rgb(12, 110, 53);
  margin-bottom: 1%;
  margin-top: 5%;
  padding-bottom: 2.5%;
  border-radius: 8%;
  font-family: "Times New Roman", Times, serif;
  font-weight: bold;
  }
</style>