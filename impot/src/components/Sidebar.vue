<script setup>
  import { RouterLink, RouterView } from 'vue-router'
  import { useRouter } from 'vue-router';
  import Swal from 'sweetalert2';

const router = useRouter();

const deconnexion = () => {
  Swal.fire({
    title: "Êtes-vous sûr?",
    text: "Vous allez être déconnecté.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Oui, me déconnecter"
  }).then((result) => {
    if (result.isConfirmed) {
      // Déconnexion confirmée, rediriger vers la page de login
      router.push({ name: 'login' });

      Swal.fire(
        'Déconnecté!',
        'Vous avez été déconnecté.',
        'success'
      );
    }
  });
};
</script>

<!--<template>
  Image and text <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="../assets/image/impot.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
    Bootstrap
  </a>
</nav>
<div></div>
<nav class="navbar navbar-expand-lg  navabar-dark " style="background-color: rgb(12, 110, 53);">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../assets/image/impot.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
       <span>SREHM</span>
       </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <RouterLink to="/accueil" class="nav-link">
            <i class="bi bi-house"></i>
            <span>Home</span>
          </RouterLink>
        </li>
        <li class="sidebar-item">
          <RouterLink id="nav" to="" class=" nav-link sidebar-link has-dropdown collapsed"  data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">  
            <i class="bi bi-wallet"></i>
            <span>Paiement</span>
          </RouterLink>
          <ul id="auth" class="sidebar-dropdown list-unstyled collapse"  data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <RouterLink id="nav" to="/caisse" class="nav-link sidebar-link">
                <i class="bi bi-cash-stack"></i>
                <span>Caisse</span>
              </RouterLink>
            </li>
            <li class="sidebar-item">
              <RouterLink id="nav" to="/virement" class="nav-link sidebar-link">
                <i class="bi bi-bank"></i>
                <span>Virement</span>
              </RouterLink>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <RouterLink to="/transfert" class="nav-link">
            <i class="bi bi-wallet"></i>
            <span>Transfert</span>
          </RouterLink>
        </li>
      </ul>
    </div>
  </div>
</nav>


</template>

<style scoped>
@media screen and (min-width:992px){
  .navbar .container-fluid, .navbar-expand-lg .navbar-collapse, .navbar-expand-lg .navbar-nav{
     flex-direction: column;
     align-items: flex-start;
  }
   .navbar{
width: 18%;
height: 100vh;
align-items: flex-start;
  }
  .navbar-brand{
    margin-left: .5rem;
    font-size: 1.5em;
    font-weight: bold;
  }

}
.navbar .navbar-nav .nav-link{
    color: #fff;
    font-size: 1em;
    font-weight: bold;
    
  }
  span{
    font-weight: bold;
    font-family: Georgia, 'Times New Roman', Times, serif;
  }

</style>-->
<template>
  
  <div class="sidebar">
    <a class="navbar-brand" href="#">
      <img src="../assets/image/impot.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
       <span>SREHM</span>
       </a>
       
    <router-link to="/dash" class="sidebar-link"> <i class="bi bi-house"></i>Accueil</router-link>
    <router-link to="/caisse" class="sidebar-link"> <i class="bi bi-wallet"></i>Caisse</router-link>
    <router-link to="/transfert" class="sidebar-link"> <i class="bi bi-cash-stack"></i>Transfert</router-link>
    <button @click="deconnexion" ><i class="bi bi-box-arrow-right" id="deconexe"></i></button></div>
</template> 
<i></i>
<script>
export default {
  name: 'Sidebar'
};
</script>

<style scoped>
.sidebar {
  width: 200px;
  height: 100vh;
  position: fixed;
  left: 0;
  right: 1%;
  top: 0;
  background-color:rgb(12, 110, 53);
  color: #fff;
  display: flex;
  flex-direction: column;
  font-family: 'Times New Roman', Times, serif;
  font-weight: bold;
}

.sidebar-link {
  padding: 15px;
  color: #fff;
  text-decoration: none;
  text-align: center;
}

.sidebar-link:hover {
  background-color: rgb(86, 145, 86);
}
a{
  text-align: center;
  padding-top: 1cm;
  
  
}
button{
  width: 20%;
  border-radius: 50%;
  padding: -2%;
  background-color:whitesmoke;
  margin-top:8.5cm;
  margin-left: 2cm;


}
span{
  text-align: center;
  padding-top: 9cm;
}
i{
  color: aliceblue,
}
#deconexe{
  color: black;
  font-weight: 100;

}

</style>

