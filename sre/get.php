<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbName = 'gestion_transfert';
$username = 'root';
$password = '';

try {
    // Connexion à la base de données via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nif = isset($_POST['nif']) ? $_POST['nif'] : '';

        if (!empty($nif)) {
            // Requête pour obtenir le nom et l'adresse de l'étudiant en fonction du NIF (nif)
            $query = "SELECT raison,adrs FROM contribuable WHERE nif = :nif";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':nif', $nif);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo json_encode($result);
            } else {
                echo json_encode(array('raison' => 'Étudiant introuvable', 'adrs' => ''));
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
