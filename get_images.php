<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(403); // Code de statut 403 : accès interdit
    echo json_encode(['error' => 'Access denied. Please log in.']);
    exit;
}

$servername = "127.0.0.1";
$username = "root";
$password = "Y@ssine2003";
$dbname = "film";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les données des images
$sql = "SELECT * FROM images";
$result = $conn->query($sql);

// Créer un tableau pour stocker les résultats
$images = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}

// Convertir le tableau en JSON pour l'utiliser avec JavaScript
echo json_encode($images);

// Fermer la connexion
$conn->close();
?>
