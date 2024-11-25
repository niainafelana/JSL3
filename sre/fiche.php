<?php
// Connexion à la base de données - À compléter avec vos informations
$host = 'localhost';
$db = 'gestion_transfert';
$user = 'root';
$password = '';
try{
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

// Récupérer les données envoyées par le JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$montant = $data['montant'];
$ref = $data['ref'];
$code="006";
$date1 =  date("Y-m-d", strtotime($data['date1']));
$date2 =  date("Y-m-d");
$nif = $data['nif'];
$banque = $data['banque'];
$social = $data['nom'];

// Insérer les données dans la base de données
$stmt = $conn->prepare("INSERT INTO virement (ref, nif, sociale, banky, vola, datevaleur) VALUES (:ref, :nif, :sociale, :banque, :montant, :date1);INSERT INTO recevoir(code,ref,dateregle) VALUES (:code, :ref, :date2)");
$stmt->bindParam(':ref', $ref);
$stmt->bindParam(':code', $code);
$stmt->bindParam(':montant', $montant);
$stmt->bindParam(':date1', $date1);
$stmt->bindParam(':date2', $date2);
$stmt->bindParam(':banque', $banque);
$stmt->bindParam(':sociale', $social);
$stmt->bindParam(':nif', $nif);

if ($stmt->execute()) {
    $response = ['success' => true, 'message' => 'Paiement réussis!'];
} 

header('Content-Type: application/json');
echo json_encode($response);}
catch(PDOException $e){
    echo json_encode($e->getMessage());
}
?>
