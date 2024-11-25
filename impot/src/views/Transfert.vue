<script setup>
import Sidebar from '../components/Sidebar.vue'
import Swal from 'sweetalert2';


const printTable = () => {
  // Sélectionner l'élément du tableau
  const tableContainer = document.getElementById('table-container');
  
  // Cloner l'élément du tableau
  const tableClone = tableContainer.cloneNode(true);
  
  // Ouvrir une nouvelle fenêtre
  const printWindow = window.open('', '', 'height=500,width=800');
  
  // Ajouter les styles CSS du document actuel
  const styleSheets = Array.from(document.styleSheets)
    .map(styleSheet => {
      try {
        return Array.from(styleSheet.cssRules)
          .map(rule => rule.cssText)
          .join('\n');
      } catch (e) {
        // Certaines feuilles de style (comme celles chargées depuis un CDN) peuvent ne pas être accessibles
        return '';
      }
    })
    .join('\n');
  
  // Styles pour l'impression
  const printStyles = `
    @media print {
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
      }
      th {
        background-color: #f2f2f2;
      }
    }
  `;
  
  // Ajouter le clone du tableau et les styles dans la nouvelle fenêtre
  printWindow.document.write('<html><head><title>Impression du tableau</title>');
  printWindow.document.write('<style>' + styleSheets + '</style>');
  printWindow.document.write('<style>' + printStyles + '</style>');
  printWindow.document.write('</head><body>');
  printWindow.document.body.appendChild(tableClone);
  printWindow.document.write('</body></html>');
  
  // Fermer le document pour que le contenu soit bien chargé
  printWindow.document.close();
  
  // Imprimer le contenu
  printWindow.print();
}

function maka() {
    const data = {
        deb: document.getElementById('debut').value,
        fin: document.getElementById('farany').value,
        emt: document.getElementById('emmetteur').value,
        dest: document.getElementById('fond').value,
        tp: document.getElementById('type').value
    };
    if (!data.deb || !data.fin || !data.emt || !data.dest || !data.tp) {

        Swal.fire({
          position: "center",
          icon: "warning",
          title: "Veuillez remplir tous les champs",
          showConfirmButton: false,
          timer: 1500
        });

        return;
    }

    document.getElementById('deb').innerHTML = data.deb;
    document.getElementById('fin').innerHTML = data.fin;
    document.getElementById('dest').innerHTML = data.dest;



    fetch('http://localhost:3000/bordereau', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json())
        .then(dat => {
            console.log(dat);
            if (data.dest == 'TG') {
                if (dat.tp == 'Espèce') {
                    document.getElementById('tgnum').innerHTML = dat.tot;
                } else if (dat.tp == 'Chèque') {
                    document.getElementById('tgch').innerHTML = dat.tot;
                }
            } else if (data.dest == 'CP') {
                document.getElementById('tgnum').innerHTML = dat.tot;
            } else if (data.dest == 'BC') {
                if (dat.tp == 'Espèce') {
                    document.getElementById('bcnum').innerHTML = dat.tot;
                } else if (dat.tp == 'Chèque') {
                    document.getElementById('bcch').innerHTML = dat.tot;
                }
            } else if (data.dest == 'BP') {
                if (dat.tp == 'Espèce') {
                    document.getElementById('bpnum').innerHTML = dat.tot;
                } else if (dat.tp == 'Chèque') {
                    document.getElementById('bpch').innerHTML = dat.tot;
                } else {
                    document.getElementById('bpvir').innerHTML = dat.tot;
                }
            }
            document.getElementById('anc').innerHTML = 5000000;
            document.getElementById('tot').innerHTML = dat.tot;
            document.getElementById('cum').innerHTML = dat.tot + dat.som + 5000000;

        })
        .catch(error => {
            console.error('Error:', error);
        });

}


</script>


<template>
    <Sidebar />
    <div class="container-fluid">
        <div class="row">
            <div class="contenu col-md-6">
                <div class="card">
                    <h5>TRANSFERT</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="debut">Du journée</label>
                                    <input type="date" class="form-control" id="debut" placeholder="Date début">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="farany">Du journée</label>
                                    <input type="date" class="form-control" id="farany" placeholder="Date farany">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text" for="banque">Destinataire</label>
                                <select class="form-select" id="banque">
                                    <option selected>Choisir</option>
                                    <option value="Tresorerie General de Fianarantsoa">Tresorerie General de
                                        Fianarantsoa</option>
                                    <option value="Tresorerie General d'Antananarivo">Tresorerie General d'Antananarivo
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text" for="emmetteur">Emmetteur</label>
                                <select class="form-select" id="emmetteur">
                                    <option selected>Choisir</option>
                                    <option value="Service Regional des Entreprises FIANARANTSOA">Service Regional des
                                        Entreprises FIANARANTSOA</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text" for="fond">Envoie de fonds</label>
                                <select class="form-select" id="fond">
                                    <option selected>Choisir</option>
                                    <option value="TG">Tresorerie General/Tresorerie Principal</option>
                                    <option value="CP">Comptable Public</option>
                                    <option value="BC">Banque Centrale</option>
                                    <option value="BP">Banque Primaire</option>
                                    <option value="CCP">CCP</option>
                                    <option value="VIR">Virement effectuer par le TG/TP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text" for="type">Type</label>
                                <select class="form-select" id="type">
                                    <option selected>Choisir</option>
                                    <option value="Espèce">Numéraires</option>
                                    <option value="Chèque">Chèque</option>
                                    <option value="Virement">Virement</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" @click="maka">Action</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="table-container">
        <div class="row">
            <div class="contenue col-md-6">
                <div class="carde">
                    <div id="tete">
                        <b>
                            <p>BORDEREAU DE TRANSFERT DE TRESORERIE</p>
                        </b>

                    </div>
                    <div id="tab">
                        <div id="identification">
                            <table>
                                <tr>
                                    <td style="width: 30%;">Numero: <span id="num"></span></td>
                                    <td>journée du <span id="deb">i</span><span id="au">au</span><span id="fin">a</span>
                                    </td>
                                </tr>
                            </table>
                        </div><br>
                        <div id="des">
                            <table>
                                <tr>
                                    <td style="width: 40%;"><b>DESTINATAIRE</b><br> <span
                                            style="margin-left:35%;"><b>T.G ou T.P :</b>30101 100</span></td>
                                    <td> <br> <span><b>Nom :</b><span id="dest">dest</span></span></td>
                                </tr>
                            </table>
                        </div><br>
                        <div id="des">
                            <table>
                                <tr>
                                    <td style="width: 40%;"><b>EMETTEUR</b><br> <span
                                            style="margin-left:35%;"><b>Règle:</b>30101 1 1520</span></td>
                                    <td> <br> <span><b>Nom :</b></span>SERVICE REGIONAL DES ENTREPRISES FIANARANTSOA
                                    </td>
                                </tr>
                            </table>
                        </div><br><br><br>
                        <!--     corps du tableau     -->

                        <div id="corps">
                            <table>
                                <tr>
                                    <td rowspan="23" style="width: 50%;">
                                        <span></span><br>
                                        <span>18231<b>-Envoi de fonds etrenglement de tresorerie auprès du: </b></span>
                                        <b> Trésorerie General/Tresoreri Principal</b><br><br>
                                        <span id="mil"><b>1823112 :</b> Numéraires</span><br>
                                        <span id="mil"><b>1823112 :</b> Chèques</span><br><br><br>
                                        <span>18 233<b>-Envoi de fonds etrenglement de tresorerie auprès d'un
                                            </b></span>
                                        <b>Comptable public</b><br><br><br>
                                        <span>18 233<b>-Envoi de fonds etrenglement de tresorerie auprès d'une
                                            </b></span>
                                        <b>Banque Centrale</b><br>
                                        <span id="mil"><b>1823112 :</b> Numéraires</span><br>
                                        <span id="mil"><b>1823112 :</b> Chèques</span><br><br><br>
                                        <span>18 234<b>-Envoi de fonds etrenglement de tresorerie auprès d'une
                                            </b></span>
                                        <b>Banque Primaire</b><br>
                                        <span id="mil"><b>182341 :</b> Numéraires</span><br>
                                        <span id="mil"><b>182342 :</b> Chèques</span><br>
                                        <span id="mil"><b>182343 :</b> Virement</span><br><br><br>
                                        <span>18 235<b>-Envoi de fonds etrenglement de tresorerie auprès d'un
                                            </b></span>
                                        <b>CPP</b><br><br>
                                        <span>18 236<b>-Virement à effectuer par le Tresorerie General/ </b></span>
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
                                    <td><span id="tgnum"><br></span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span id="tgch"></span></td>
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
                                    <td rowspan="3"><br></td>
                                    <td rowspan="3"><br></td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <td rowspan="2"><span id="bcnum"><br></span> <br> <span id="bcch"><br></span></td>
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
                                    <td id="bpnum"><br></td>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td id="bpch"><br></td>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td id="bpvir"><br></td>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td rowspan="2"></td>
                                    <td rowspan="2"><br></td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <td rowspan="3"><br> <br></td>
                                    <td rowspan="3"> <br> <br></td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <td><b>TOTAL</b></td>
                                    <td id="tot"><br></td>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td><b>MONTANT DES REGLEMENTS ANTERIEUR</b></td>
                                    <td id="anc"><br></td>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td id="fefe"><b>TOTAL CUMMULE DE L'ANNE</b></td>
                                    <td id="cum"><br></td>
                                    <td><br></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div>

                            <p id="bas"><b>DR N</b><span id="left"><b>Fianarantsoa, le <span
                                            id="date"></span></b></span></p><br><br>
                            <p id="bas"><b>Le T.G ou T.P</b><span id="left"> <b>Le Receveur des Impôts SRE HAUTE
                                        MATSIATRA</b></span></p>

                        </div>
                        <button id='alertbutton' @click="printTable">Imprimer</button>

                    </div>

                </div>
            </div>
        </div>
    </div>


</template>
<style scoped>

table {
      width: 100%;
      border-collapse: collapse;
      page-break-inside: auto;
      font-family: 'Times New Roman', Times, serif;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
      text-align: left;
    }
    
    /* Réglages spécifiques pour la mise en page */
    #tete {
      margin-top: 20px;
    }
    #tab {
      margin-top: 20px;
    }
    #identification {
      margin-top: 20px;
    }
    #des {
      margin-top: 20px;
      padding-right: 10%;
    }


.contenu {
    float: right;

    margin-left: 39%;

}

.card {
    top: 50%;
    left: 40%;
    width: 1000px;
    padding: 20px 29px;
    transform: translate(-50%, -50%);
    font-size: 40%;

}

.contenue {

    margin-left: 20%;

}

.carde {

    left: 40%;
    width: 1000px;
    padding: 20px 29px;
    font-size: xx-small;

}

.raw {
    display: flex;
    gap: 10px;
    font-size: small;
}

table {
    width: 10%;
}

table,
tr,
td,
th {
    border-collapse: collapse;
    border: 2px solid black;
}

#identification>table {
    width: 85%;
}

#dest>table,
#corps>table {
    width: 100%;
}

#au {
    margin-left: 40%;
}

#fin,
#deb {
    margin-left: 10%;
}

#mil {
    margin-left: 40%;
}

body {
    margin: 3%;
}

#left {
    text-align: end;
}

#left {
    text-indent: 8cm;
}


.container-fluid {
    padding: 20px;
    
}

.card {
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.btn-primary {
    background-color:rgb(12, 110, 53);
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    width: 20%;
    
}

.text-center {
    text-align: center;
}

h5 {
    font-weight: bold;
}
#table-container{
    margin-top: 10cm;
}


</style>