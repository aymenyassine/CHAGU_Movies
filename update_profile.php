<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "Y@ssine2003";
$dbname = "film";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION["id"]; // Assurez-vous que 'id' est bien stocké dans la session
    $newUsername = $_POST['new_username'];
    $passwordInput = $_POST['password'];

    // Vérifier le mot de passe
    $sql = "SELECT password FROM users WHERE id='$userId'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if (password_verify($passwordInput, $user['password'])) {
        // Si le mot de passe est correct, on met à jour le nom d'utilisateur
        $updateSQL = "UPDATE users SET nom='$newUsername' WHERE id='$userId'";
        if ($conn->query($updateSQL)) {
            echo '<script>
                    alert("Nom d\'utilisateur mis à jour avec succès !");
                    window.location.href = "profile.html"; // Rediriger vers la page du profil après la mise à jour
                  </script>';
        } else {
            echo "Erreur lors de la mise à jour du nom d'utilisateur.";
        }
    } else {
        echo "Le mot de passe est incorrect.";
    }
}

$conn->close();
?>
