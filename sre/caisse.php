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

$nif = $data['nif'];
$montant = $data['montant'];
$mode = $data['mode'];
$code="006";
$datep = date("Y-m-d");

// Insérer les données dans la base de données
$stmt = $conn->prepare("INSERT INTO paiement (nif, code, mode, montant, datepaie) VALUES (:nif, :code, :mode, :montant, :datep)");
$stmt->bindParam(':nif', $nif);
$stmt->bindParam(':code', $code);
$stmt->bindParam(':mode', $mode);
$stmt->bindParam(':montant', $montant);
$stmt->bindParam(':datep', $datep);

if ($stmt->execute()) {
    $response = ['success' => true, 'message' => 'Paiement réussis!'];
} 

header('Content-Type: application/json');
echo json_encode($response);}
catch(PDOException $e){
    echo json_encode($e->getMessage());
}
?>
