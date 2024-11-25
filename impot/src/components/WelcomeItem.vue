<template>
  <div class="item">
    <i>
      <slot name="icon"></slot>
    </i>
    <div class="details">
      <h3>
        <slot name="heading"></slot>
      </h3>
      <slot></slot>
    </div>
  </div>
</template>

<style scoped>

#fig{
  width: 25%;
  margin-top: -20%;
  margin-left: 19%;
  border-radius: 20%;
  float: left;
}
#figu{
  width: 25%;
  margin-top: -2%;
  margin-left: 19%;
  border-radius: 20%;
  float: right;
  margin-right: 5%;
}
#teple{
  margin: 0%;
  padding-top: 0%;
}
body{
    margin: 0%;
    padding: 0%;

}

/******bouton****/
#caisse{
    background-color:rgb(12, 110, 53);
    font-family: Segoe UI;
    padding-right: 1.6cm;
    margin-bottom: 0.5cm;
    font-weight: bolder;
}
#virement{
    background-color:rgb(12, 110, 53);
    font-family: Segoe UI;
    padding-right: 1.1cm;
    margin-bottom: 0.5cm;
    font-weight: bolder;
}
#transfert{
    background-color: rgb(12, 110, 53);
    font-family: Segoe UI;
    font-size: medium;
    padding-right: 1cm;
    font-weight: bolder;
}
#ok{
    padding-left: 30%;
    align-items: flex-start;
    margin-top: -30%;
    margin-right: 15%;
   
}




</style>
