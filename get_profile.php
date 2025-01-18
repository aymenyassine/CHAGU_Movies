<?php
// Connexion à la base de données
$host = '127.0.0.1';
$dbname = 'film';
$user = 'root';
$password = 'Y@ssine2003';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

session_start();
$userId = $_SESSION['id'] ?? 1; // Remplacez 1 par l'ID utilisateur réel

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Utilisateur introuvable.");
}

// Retourner les données sous forme JSON
header('Content-Type: application/json');
echo json_encode($user);
?>
