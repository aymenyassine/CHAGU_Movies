<?php
// Connexion à la base de données
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

// Récupérer le terme de recherche
$searchTerm = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// Construire la requête SQL
$sql = "SELECT * FROM images WHERE nom LIKE '%$searchTerm%' LIMIT 10"; // Limite les résultats à 10

$result = $conn->query($sql);

// Tableau pour stocker les films
$films = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
}

// Fermer la connexion
$conn->close();

// Retourner les films en format JSON
header('Content-Type: application/json');
echo json_encode($films);
?>
