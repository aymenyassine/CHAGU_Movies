<?php
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

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des données du formulaire
    $nom = $_POST['full_name'];
    $numero_de_telephone = $_POST['phone_number'];
    $email = $_POST['email_register'];
    $password = password_hash($_POST['password_register'], PASSWORD_BCRYPT);

    // Préparation de la requête SQL
    $sql = "INSERT INTO users (nom, numero_de_telephone, email, password) 
            VALUES ('$nom', '$numero_de_telephone', '$email', '$password')";

    // Exécution de la requête SQL
    if ($conn->query($sql) === TRUE) {
        header("Location: form.html");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fermeture de la connexion
$conn->close();
?>
