<script setup>
import Sidebar from '../components/Sidebar.vue'
</script>

<template id="teple">
  <Sidebar/>
    <div id="ok" class="text-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" id="caisse" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Caisse
            </button> <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" id="virement" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Virement
            </button> <br>
            <!-- Button tsotra -->
            <a href=""><button type="button" id="transfert" class="btn btn-secondary btn-lg">Transfert</button></a><br> 
            </div>
            <figure  class="text-center">
            <img id="fig" src="../assets/image/mudey-online.webp"  alt="">
            </figure>
            <figure  class="text-center">
            <img id="figu" src="../assets/image/plan-cours.webp"  alt="">
            </figure>

</template>
<style scoped>
#fig{
  width: 25%;
  padding-top: -10000%;
  margin-left: 19%;
  border-radius: 20%;
  float: left;
}
#figu{
  width: 25%;
  border-radius: 20%;
  float: right;
  
}
</style>