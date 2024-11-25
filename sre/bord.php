<?php
// Connexion à la base de données - À compléter avec vos informations
$host = 'localhost';
$db = 'gestion_transfert';
$user = 'root';
$password = '';
try{
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $vnum =$_POST['num'];
    $vvir=$_POST['vir'];
    $vch=$_POST['ch'];
    $montant = $vch+$vvir+$vnum;


    
    $code="006";
    $date1 =  date("Y-m-d", strtotime($_POST['deb']));
    $date2 =  date("Y-m-d", strtotime($_POST['fin']));
    $datetrans = date("Y-m-d");
    $dest= $_POST['dest'];
    $nom = $_POST['typ'];
   

    $st= $conn->prepare("SELECT codeser,nom FROM tresorerie WHERE lib=:nom");
    $st->bindParam(':nom', $nom);
    $st->execute();
    $ro= $st->fetch(PDO::FETCH_ASSOC);
    $codeser = $ro['codeser'];
    $name= $ro['nom'];
   
    // Insérer les données dans la base de données
    $stmt = $conn->prepare("INSERT INTO transfert (code, codeser, datedeb, datefin, datetrans, som) VALUES (:code,:codeser,:datedeb, :datefin, :datetrans, :som)");
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':som', $montant);
    $stmt->bindParam(':datedeb', $date1);
    $stmt->bindParam(':datefin', $date2);
    $stmt->bindParam(':datetrans', $datetrans);
    $stmt->bindParam(':codeser', $codeser); 

    if($stmt->execute()){
       
    }

    $stat = $conn->prepare("SELECT MAX(idtrans) AS num FROM transfert");
    $stat-> execute();
    if($result = $stat->fetch(PDO::FETCH_ASSOC)){
        echo'<script>alert("misy")</script>';
    }    
    $stt = $conn->prepare("SELECT SUM(som) AS taloha FROM transfert WHERE idtrans<(SELECT MAX(idtrans) AS num FROM transfert)");
    $stt-> execute();
    if($rs = $stt->fetch(PDO::FETCH_ASSOC)){
        $taloha = $rs['taloha'];
    }


}

}
catch(PDOException $e){
    echo json_encode($e->getMessage());
}
//variable de chaque cellule
$num1 ="<br>";
$ch1 ="<br>";
$sm ="<br><br>";
$sm1="<br><br>";
$num2="<br>";
$ch2="<br>";
$vir="<br>";
$cpp="<br><br";
$tctp="<br><br>";

switch($dest){
    case "TG/TP":
        $num1 =$vnum;
        $ch1 =$vch;
        $montant= $num1+$ch1;
        break;
    case "CP":
       $sm=$montant+"<br><br>";
      
        break;
    case "BC":
       $sm1=$vnum +"<br>"+$vch;
       
       break;
     case "BP":
            $num2=$vnum;
            $ch2=$vch;
            $vir=$vvir;
            
        break;
    case "CPP":
       $cpp=$montant;
      
        break;
     case "TG/TPR":
        $tctp=$montant;
       
         break;      
        
}
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bordereau</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
<body >
<div id="tete">
    <b><p>BORDEREAU DE TRANSFERT DE TRESORERIE</p></b>
    <p><b>Rubrique:1825 Envoie de Fonds et reglement de trésorerie entre Comptable</b></p>
</div>
<div id="identification">
    <table>
    <tr>
        <td style="width: 30%;">Numero: <span id="num"><?php echo $result['num'];?></span></td>
        <td>journée du <span id="deb"><?php echo date("d/m/Y",strtotime($date1));?></span><span id="au">au</span><span id="fin"><?php echo date("d/m/Y",strtotime($date2));?></span></td>
    </tr>
    </table>
</div><br>
<div id="dest">
    <table>
    <tr>
        <td style="width: 40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DESTINATAIRE</b><br> <span style="margin-left:35%;"><b>T.G ou T.P :</b> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $codeser; ?></span></td>
        <td> <br> <span><b>Nom :</b></span>&nbsp;&nbsp;<?php echo $name; ?></td>
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
            <td id="num1"> <?php echo $num1 ;?></td>
            <td></td>
        </tr>
        <tr>
            <td id="ch1"><?php echo $ch1 ;?></td>
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
            <td rowspan="3"><?php echo $sm ;?></td>
            <td rowspan="3"><br><br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td id="numch" rowspan="2"><?php echo $sm1 ;?></td>
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
            <td id="num2"><?php echo $num2 ;?></td>
            <td><br></td>
        </tr>
        <tr>
            <td id="ch2"><?php echo $ch2 ;?></td>
            <td><br></td>
        </tr>
        <tr>
            <td id="vir"><?php echo $vir ;?></td>
            <td><br></td>
        </tr>
        <tr>
            <td rowspan="2"><?php echo $cpp ;?></td>
            <td rowspan="2"><br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td rowspan="3"><?php echo $tctp ;?></td>
            <td rowspan="3"> <br>  <br></td>
        </tr>
        <tr>
            
        </tr>
        <tr>
           
        </tr>
        <tr>
            <td><b>TOTAL</b></td>
            <td id="tot"><?php echo $montant ;?></td>
            <td><br></td>
        </tr>
        <tr>
            <td><b>MONTANT DES REGLEMENTS ANTERIEUR</b></td>
            <td id="ancien"><?php echo $taloha ;?></td>
            <td><br></td>
        </tr>
        <tr>
            <td><b>TOTAL CUMMULE DE L'ANNE</b></td>
            <td id="an"><?php echo $montant+$taloha ;?></td>
            <td><br></td>
        </tr>
    </table>
</div>
<div>
    <p id="bas"><b>DR N</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="left"><b>Fianarantsoa, le <span id="date"></span></b></span></p><br><br>
    <p id="bas"><b>Le T.G ou T.P</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="left"> <b>Le Receveur des Impôts SRE HAUTE MATSIATRA</b></span></p>
    
</div>
<button type="button" id="printButton" class="btn btn-primary">Primary</button>
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
    document.getElementById('printButton').addEventListener('click', function() {
      // Cacher le bouton d'impression
      this.style.display = 'none';

      // Attendre un court instant pour que le bouton se rende caché
      setTimeout(function() {
        // Déclencher l'impression
        window.print();

        // Afficher à nouveau le bouton après l'impression
        document.getElementById('printButton').style.display = 'block';
      }, 1000); // Temps d'attente en millisecondes (1 seconde dans cet exemple)
    });
</script>
    
</body>
</html>
