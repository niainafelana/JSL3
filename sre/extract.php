<?php
// Connexion à la base de données - À compléter avec vos informations
$host = 'localhost';
$db = 'gestion_transfert';
$user = 'root';
$password = '';
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    // Récupérer les données envoyées par le JavaScript
    $data = json_decode(file_get_contents('php://input'), true);
    $tp = $data['tp'];
    $date1 = date("Y-m-d", strtotime($data['debut']));
    $date2 = date("Y-m-d", strtotime($data['farany']));
    $vir= $data['invir'];
    $num=$data['inum'];
    $ch=$data['inch'];
    $reponse = array();

    if ($vir == 'oui') {
        $stmt = $conn->prepare("SELECT SUM(virement.vola) as  volavir FROM virement JOIN recevoir ON virement.ref=recevoir.ref WHERE dateregle BETWEEN :date1 AND :date2");
        $stmt->bindParam(':date1', $date1);
        $stmt->bindParam(':date2', $date2);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $reponse['virement']=$result;
        } else {
            $reponse['virement']=array("virement"=>0);
        }
    } else{
        $reponse['virement']=array("virement"=>0);
    }
    if($num == 'oui') {
        $stat = $conn->prepare("SELECT SUM(montant) as volanum FROM paiement WHERE mode='Espèce' AND datepaie BETWEEN :date1 AND :date2");
        $stat->bindParam(':date1', $date1);
        $stat->bindParam(':date2', $date2);
        $stat->execute();
        $resultat = $stat->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            $reponse['numeraire']=$resultat;
        } else {
            $reponse['numeraire']=array("numeraire"=>0);
        }
       
    }else{
        $reponse['numeraire']=array("numeraire"=>0);
    }
    if($ch == 'oui') {
        $stt = $conn->prepare("SELECT SUM(montant) as volach FROM paiement WHERE mode='Chèque' AND datepaie BETWEEN :date1 AND :date2");
        $stt->bindParam(':date1', $date1);
        $stt->bindParam(':date2', $date2);
        $stt->execute();
        $rs = $stt->fetch(PDO::FETCH_ASSOC);
        if ($rs) {
            $reponse['cheque']=$rs;
        } else {
            $reponse['cheque']=array("cheque"=>0);
        }
       
    }else{
        $reponse['cheque']=array("cheque"=>0);
    }
    echo json_encode($reponse);
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}
?>
