<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Y@ssine2003";
$dbname = "film";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si un ID est passé
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'entrée utilisateur

    // Requête préparée pour récupérer un film par son ID
    $stmt = $conn->prepare("SELECT id, nom, chemin, description FROM images WHERE id = ?");
    $stmt->bind_param("i", $id); // Associer l'ID à la requête
    $stmt->execute();
    $result = $stmt->get_result();

    $film = $result->fetch_assoc(); // Récupérer le film sous forme de tableau associatif
    echo json_encode($film); // Retourner les données en JSON

    $stmt->close();
} else {
    // Retourner une erreur si l'ID n'est pas passé
    echo json_encode(['error' => 'Aucun ID spécifié']);
}

$conn->close();
?>
