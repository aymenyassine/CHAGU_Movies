<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Y@ssine2003";
$dbname = "film";

// Obtenir les données envoyées via AJAX
$data = json_decode(file_get_contents('php://input'), true);
$filmName = $data['name'];

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Supprimer le film de la base de données
$stmt = $conn->prepare("DELETE FROM images WHERE nom = ?");
$stmt->bind_param("s", $filmName);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
