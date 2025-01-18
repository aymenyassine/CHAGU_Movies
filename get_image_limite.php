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

// Récupérer les 4 premiers films de la base de données
$sql = "SELECT * FROM images LIMIT 4";
$result = $conn->query($sql);

// Tableau pour stocker les films
$films = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
}

// Fermer la connexion
$conn->close();

// Retourner les films en format JSON
echo json_encode($films);
?>
