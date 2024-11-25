<?php
// Connexion à la base de données - À compléter avec vos informations
$host = 'localhost';
$db = 'gestion_transfert';
$user = 'root';
$password = '';
try{
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Récupérer les données envoyées par le JavaScript
$data = json_decode(file_get_contents('php://input'), true);

$typ = $data['type'];
$date1 = $data['debut'];
$date2 = $data['fin'];
$code = "006";
$codeser = "010";

$debut = date("Y-m-d", strtotime($date1));
$fin = date("Y-m-d", strtotime($date2));

 switch($typ){
    case "virement":
        //selection ny somme atao transfer avy am table virement joingnevana am table recevoir
                $stmt = $conn->prepare("SELECT SUM(virement.vola) as vola FROM virement JOIN recevoir on virement.ref=recevoir.ref WHERE recevoir.dateregle BETWEEN :debut AND : fin");
                $stmt->bindParam(':debut', $debut);
                $stmt->bindParam(':fin', $fin);
                $stmt->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $vola = $result['vola'];
        //manao insertion de la somme et des donnée dans la table transfert
                $state = $conn->prepare("INSERT INTO transfert(code, codeser, typ, datedeb, datefin, som) VALUES (:code, :codeser, :typ; :datedeb, :datefin, :som)");
                $state->bindParam(":code",$code);
                $state->bindParam(":codeser",$codeser);
                $state->bindParam(":typ",$typ);
                $state->bindParam(":datedeb",$debut);
                $state->bindParam("datefin",$fin);
                $state->bindParam("som",$vola);

                if ($state->execute()) {
                    $response = ['success' => true, 'message' => 'transfert réussis!'];
                }else{
                    $response = ['success' => false, 'message' => 'transfert non réussis'];
                }
        //manao recuperation anlay id an transfert natao farany teo mazava oazy fa iny no farany ambony ao donc mapias fontion max
                $rec = $conn->prepare("SELECT MAX(idtrans) FROM transfert");
                $rec->execute();
                $res = $statement->fetch(PDO::FETCH_ASSOC);
                $id = $res['idtrans'];
                
                break;

    case "chèque":
                $stmt = $conn->prepare("SELECT SUM(montant) as vola FROM paiement  WHERE mode =:typ datepaie BETWEEN :debut AND : fin");
                $stmt->bindParam(':debut', $debut);
                $stmt->bindParam(':fin', $fin);
                $stmt->bindParam(':typ', $typ);
                $stmt->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                 //manao insertion de la somme et des donnée dans la table transfert
                 $state = $conn->prepare("INSERT INTO transfert(code, codeser, typ, datedeb, datefin, som) VALUES (:code, :codeser, :typ; :datedeb, :datefin, :som)");
                 $state->bindParam(":code",$code);
                 $state->bindParam(":codeser",$codeser);
                 $state->bindParam(":typ",$typ);
                 $state->bindParam(":datedeb",$debut);
                 $state->bindParam("datefin",$fin);
                 $state->bindParam("som",$vola);
 
                 if ($state->execute()) {
                     $response = ['success' => true, 'message' => 'transfert réussis!'];
                 }else{
                     $response = ['success' => false, 'message' => 'transfert non réussis'];
                 }
         //manao recuperation anlay id an transfert natao farany teo mazava oazy fa iny no farany ambony ao donc mapias fontion max otran teo ambony
                 $rec = $conn->prepare("SELECT MAX(idtrans) FROM transfert");
                 $rec->execute();
                 $res = $statement->fetch(PDO::FETCH_ASSOC);
                 $id = $res['idtrans'];

                break;

            }
            
 
}
catch(PDOException $e){
    echo json_encode($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bordereau</title>
    <style>
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
</head>
<body onload="print()">
<div id="tete">
    <b><p>BORDEREAU DE TRANSFERT DE TRESORERIE</p></b>
    <p><b>Rubrique:1825 Envoie de Fonds et reglement de trésorerie entre Comptable</b></p>
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
        <td style="width: 40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DESTINATAIRE</b><br> <span style="margin-left:35%;"><b>T.G ou T.P :</b> &nbsp;&nbsp;&nbsp;&nbsp;30101 100</span></td>
        <td> <br> <span><b>Nom :</b></span>&nbsp;&nbsp;Tresorerie General de FIANARANTSOA</td>
    </tr>
    </table>
</div><br>
<div id="dest">
    <table>
    <tr>
        <td style="width: 40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>EMETTEUR</b><br> <span style="margin-left:35%;"><b>Règle:</b> &nbsp;&nbsp;&nbsp;&nbsp;30101 1 1520</span></td>
        <td> <br> <span><b>Nom :</b></span>&nbsp;&nbsp;SERVICE REGIONAL DES ENTREPRISES  FIANARANTSOA</td>
    </tr>
    </table>
</div><br><br><br>
<!--     corps du tableau     -->

<div id="corps">
    <table>
        <tr>
            <td rowspan="23" style="width: 50%;">
                <span></span><br>
                <span>18231 &nbsp;&nbsp;&nbsp;&nbsp;<b>-Envoi de fonds etrenglement de tresorerie auprès  du:   </b></span>
               <b> Trésorerie General/Tresoreri Principal</b><br><br>
               <span id="mil"><b>1823112  :</b> Numéraires</span><br>
               <span id="mil"><b>1823112  :</b> Chèques</span><br><br><br>
               <span>18 233 &nbsp;&nbsp;&nbsp;&nbsp;<b>-Envoi de fonds etrenglement de tresorerie auprès  d'un </b></span>
               <b>Comptable public</b><br><br><br>
               <span>18 233 &nbsp;&nbsp;&nbsp;&nbsp;<b>-Envoi de fonds etrenglement de tresorerie auprès  d'une   </b></span>
               <b>Banque Centrale</b><br>
               <span id="mil"><b>1823112  :</b> Numéraires</span><br>
               <span id="mil"><b>1823112  :</b> Chèques</span><br><br><br>
               <span>18 234 &nbsp;&nbsp;&nbsp;&nbsp;<b>-Envoi de fonds etrenglement de tresorerie auprès  d'une  </b></span>
               <b>Banque Primaire</b><br>
               <span id="mil"><b>182341  :</b> Numéraires</span><br>
               <span id="mil"><b>182342  :</b> Chèques</span><br>
               <span id="mil"><b>182343 :</b> Virement</span><br><br><br>
               <span>18 235 &nbsp;&nbsp;&nbsp;&nbsp;<b>-Envoi de fonds etrenglement de tresorerie auprès  d'un </b></span>
               <b>CPP</b><br><br>
               <span>18 236 &nbsp;&nbsp;&nbsp;&nbsp;<b>-Virement à effectuer par le Tresorerie General/  </b></span>
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
            <td rowspan="2"><?php echo $result['vola'];?></td>
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
    <p id="bas"><b>DR N</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="left"><b>Fianarantsoa, le <span id="date"></span></b></span></p><br><br>
    <p id="bas"><b>Le T.G ou T.P</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="left"> <b>Le Receveur des Impôts SRE HAUTE MATSIATRA</b></span></p>
    
</div>
<script>
    var d = new Date();
    var day = d.getDate();
    var mois = d.getMonth();
    var an = d.getFullYear();
    var daty;
    if(mois<10){
        daty = day+"/0"+mois+"/"+an;
    }else{
        daty = day+"/"+mois+"/"+an;
    }
    document.getElementById("date").innerHTML= daty;
</script>
    
</body>
</html>
