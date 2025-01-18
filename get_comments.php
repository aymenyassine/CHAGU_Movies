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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'entrée utilisateur

    // Requête préparée pour récupérer les commentaires associés au film
    $stmt = $conn->prepare("SELECT * FROM commentaires WHERE image_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    echo json_encode($comments); // Retourner les commentaires en JSON

    $stmt->close();
} else {
    echo json_encode(['error' => 'Aucun ID spécifié']);
}

$conn->close();
?>
