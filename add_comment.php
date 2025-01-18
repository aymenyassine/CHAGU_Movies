<?php
session_start();
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

// Vérifier si les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_id = intval($_POST['image_id']);
    $texte = $conn->real_escape_string($_POST['texte']);
    $nom = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : 'Anonyme'; // Utiliser 'Anonyme' si pas connecté

    // Requête préparée pour insérer un nouveau commentaire
    $stmt = $conn->prepare("INSERT INTO commentaires (image_id, commentaire, auteur, date_creation) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $image_id, $texte, $nom);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Commentaire ajouté avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du commentaire.']);
    }

    $stmt->close();
}

$conn->close();
?>
