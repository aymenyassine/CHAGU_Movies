
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

// Récupérer tous les films
$sql = "SELECT id,nom,chemin,description FROM images"; // Assurez-vous que votre table et les colonnes sont correctes
$result = $conn->query($sql);

$films = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
}

$conn->close();

// Retourner les films en JSON
echo json_encode($films);
?>
