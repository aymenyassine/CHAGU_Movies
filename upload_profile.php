<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "Y@ssine2003";
$dbname = "film";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION["id"])) {
        echo json_encode(['success' => false, 'error' => "Vous devez être connecté pour télécharger une photo."]);
        exit;
    }

    $userId = $_SESSION["id"];  // ID de l'utilisateur à partir de la session
    $imagePath = null;

    // Vérifier si une image a été téléchargée
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === 0) {
        $imageName = $_FILES['profile_photo']['name'];
        $imageTmpName = $_FILES['profile_photo']['tmp_name'];
        $imageDir = "img/profile/";
        $imagePath = $imageDir . basename($imageName);

        // Vérifier le type d'image avant de la déplacer
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profile_photo']['type'], $allowedTypes)) {
            echo json_encode(['success' => false, 'error' => "Type de fichier non autorisé."]);
            exit;
        }

        // Déplacer l'image vers le dossier de destination
        if (!move_uploaded_file($imageTmpName, $imagePath)) {
            echo json_encode(['success' => false, 'error' => "Erreur lors du téléchargement de l'image."]);
            exit;
        }
    }

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Préparer la requête pour mettre à jour la photo de profil
    if ($imagePath) {
        // Si une nouvelle photo a été téléchargée, mettre à jour le chemin dans la base de données
        $stmt = $conn->prepare("UPDATE users SET photo = ? WHERE id = ?");
        $stmt->bind_param("si", $imagePath, $userId);
    } else {
        echo json_encode(['success' => false, 'error' => "Aucune photo téléchargée."]);
        exit;
    }

    // Exécuter la requête
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => "Photo mise à jour avec succès !"]);
    } else {
        echo json_encode(['success' => false, 'error' => "Erreur lors de la mise à jour de la photo."]);
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
}
?>
