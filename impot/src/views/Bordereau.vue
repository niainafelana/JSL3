<script setup>
</script>
<template>
    <div id="tete">
    <b><p>BORDEREAU DE TRANSFERT DE TRESORERIE</p></b>
  
</div>
<div id="identification">
    <table>
    <tr>
        <td style="width: 30%;">Numero: <span id="num">i</span></td>
        <td>journée du <span id="deb">i</span><span id="au">au</span><span id="fin">a</span></td>
    </tr>
    </table>
</div><br>
<div id="dest">
    <table>
    <tr>
        <td style="width: 40%;"><b>DESTINATAIRE</b><br> <span style="margin-left:35%;"><b>T.G ou T.P :</b>30101 100</span></td>
        <td> <br> <span><b>Nom :</b></span></td>
    </tr>
    </table>
</div><br>
<div id="dest">
    <table>
    <tr>
        <td style="width: 40%;"><b>EMETTEUR</b><br> <span style="margin-left:35%;"><b>Règle:</b>30101 1 1520</span></td>
        <td> <br> <span><b>Nom :</b></span>SERVICE REGIONAL DES ENTREPRISES  FIANARANTSOA</td>
    </tr>
    </table>
</div><br><br><br>
<!--     corps du tableau     -->

<div id="corps">
    <table>
        <tr>
            <td rowspan="23" style="width: 50%;">
                <span></span><br>
                <span>18231<b>-Envoi de fonds etrenglement de tresorerie auprès  du:   </b></span>
               <b> Trésorerie General/Tresoreri Principal</b><br><br>
               <span id="mil"><b>1823112  :</b> Numéraires</span><br>
               <span id="mil"><b>1823112  :</b> Chèques</span><br><br><br>
               <span>18 233<b>-Envoi de fonds etrenglement de tresorerie auprès  d'un </b></span>
               <b>Comptable public</b><br><br><br>
               <span>18 233<b>-Envoi de fonds etrenglement de tresorerie auprès  d'une   </b></span>
               <b>Banque Centrale</b><br>
               <span id="mil"><b>1823112  :</b> Numéraires</span><br>
               <span id="mil"><b>1823112  :</b> Chèques</span><br><br><br>
               <span>18 234<b>-Envoi de fonds etrenglement de tresorerie auprès  d'une  </b></span>
               <b>Banque Primaire</b><br>
               <span id="mil"><b>182341  :</b> Numéraires</span><br>
               <span id="mil"><b>182342  :</b> Chèques</span><br>
               <span id="mil"><b>182343 :</b> Virement</span><br><br><br>
               <span>18 235<b>-Envoi de fonds etrenglement de tresorerie auprès  d'un </b></span>
               <b>CPP</b><br><br>
               <span>18 236<b>-Virement à effectuer par le Tresorerie General/  </b></span>
               <b>Tresorerie Principal de rattachement</b><br>
           </td>
            <th>DEBIT</th>
            <th>CREDIT</th>
            <th style="width:20%;">OBSERVATION</th>
        </tr>
        <tr>
            <td rowspan="2"> <br> </td>
            <td rowspan="26"></td>
            <td rowspan="2"><br> </td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td rowspan="3"><br><br></td>
            <td rowspan="3"><br><br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td rowspan="3"><br><br></td>
            <td rowspan="3"><br><br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td rowspan="2"><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td rowspan="2"><br></td>
            <td rowspan="2"><br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td rowspan="2"></td>
            <td rowspan="2"><br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td rowspan="3"><br>  <br></td>
            <td rowspan="3"> <br>  <br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
           
        </tr>
        <tr>
            <td><b>TOTAL</b></td>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td><b>MONTANT DES REGLEMENTS ANTERIEUR</b></td>
            <td><br></td>
            <td><br></td>
        </tr>
        <tr>
            <td><b>TOTAL CUMMULE DE L'ANNE</b></td>
            <td><br></td>
            <td><br></td>
        </tr>
    </table>
</div>
<div>
    <p id="bas"><b>DR N</b><span id="left"><b>Fianarantsoa, le <span id="date"></span></b></span></p><br><br>
    <p id="bas"><b>Le T.G ou T.P</b><span id="left"> <b>Le Receveur des Impôts SRE HAUTE MATSIATRA</b></span></p>
    
</div>

</template>
<style scoped>
table{
    width: 10%;
}
 table,tr,td,th{
            border-collapse: collapse;
            border: 2px solid black;
        }
        #identification>table{
            width: 85%;
        }
        #dest>table,#corps>table{
            width: 100%;
        }
      #au{
            margin-left: 40%;
        }
        #fin,#deb{
            margin-left: 10%;
        }
        #mil{
            margin-left: 40%;
        }
        body{
            margin:3%;
        }
        #left{
            text-align: end;
        }
        #left{
            text-indent: 8cm;
        }
</style>