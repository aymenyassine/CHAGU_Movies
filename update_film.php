

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Y@ssine2003";
$dbname = "film";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $imagePath = null;

    // Vérifiez si une image a été téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageDir = "img/pster/";
        $imagePath = $imageDir . basename($imageName);

        // Déplacez l'image vers le dossier
        if (!move_uploaded_file($imageTmpName, $imagePath)) {
            echo json_encode(['success' => false, 'error' => "Erreur lors du téléchargement de l'image"]);
            exit;
        }
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Échec de connexion : " . $conn->connect_error);
    }

    if ($imagePath) {
        $stmt = $conn->prepare("UPDATE images SET nom = ?, description = ?, chemin = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $description, $imagePath, $filmId);
    } else {
        $stmt = $conn->prepare("UPDATE images SET nom = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $filmId);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => "Erreur lors de la modification du film"]);
    }

    $stmt->close();
    $conn->close();
}
?>

