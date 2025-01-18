<?php
session_start();
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
    // Récupération des données du formulaire
    $email = $_POST['email_login'];
    $password = $_POST['password_login'];

    // Préparation de la requête SQL pour récupérer l'utilisateur
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    // Vérification des résultats
    if ($result->num_rows > 0) {
        // Récupération des données utilisateur
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $status = $row['status'];
        $attempts = $row['attempts'];
        $banned_until = $row['banned_until'];
        
        // Vérifier si l'utilisateur est banni
        if ($banned_until && strtotime($banned_until) > time()) {
            echo '<script>
                    alert("Votre compte est temporairement banni jusqu\'à ' . date("d/m/Y H:i:s", strtotime($banned_until)) . '. Veuillez réessayer plus tard.");
                    window.location.href = "form.html"; 
                </script>';
        } else {
            // Vérification du mot de passe
            if (password_verify($password, $hashed_password) && $status == 'Actif') {
                // Réinitialiser le nombre de tentatives
                $conn->query("UPDATE users SET attempts = 0 WHERE email = '$email'");
                $_SESSION['logged_in'] = true;
                $_SESSION['user_name'] = $row['nom'];
                $_SESSION['id']= $row['id'];
                header("Location: index.html");
            } else if($status != 'Actif'){
                echo '<script>
                    alert("Votre compte est banni. Contactez le support!");
                    window.location.href = "Contact us.html"; 
                </script>';
            } else {
                // Incrémenter le nombre de tentatives incorrectes
                $attempts++;
                $conn->query("UPDATE users SET attempts = $attempts WHERE email = '$email'");
                
                // Si l'utilisateur atteint 3 tentatives incorrectes
                if ($attempts == 3) {
                    // Bannir l'utilisateur pendant 30 minutes
                    $banned_until = date('Y-m-d H:i:s', strtotime('+5 minutes'));
                    $conn->query("UPDATE users SET banned_until = '$banned_until' WHERE email = '$email'");
                    echo '<script>
                        alert("Votre compte est temporairement banni pendant 5 minutes en raison de 3 tentatives infructueuses.");
                        window.location.href = "form.html"; 
                    </script>';
                }
                // Si l'utilisateur atteint 5 tentatives incorrectes
                else if ($attempts == 5) {
                    // Bannir l'utilisateur de façon permanente
                    $conn->query("UPDATE users SET status = 'Banni' WHERE email = '$email'");
                    echo '<script>
                        alert("Votre compte est définitivement banni après 5 tentatives infructueuses.");
                        window.location.href = "form.html"; 
                    </script>';
                } else {
                    echo '<script>
                        alert("Votre mot de passe est incorrect! 😜 Vous avez encore' .(5 - $attempts) . ' tentative(s).");
                        window.location.href = "form.html"; 
                    </script>';
                }
            }
        }
    } else {
        echo  '<script>
        alert("Aucun utilisateur trouvé avec cet email.! ☹️");
         window.location.href = "form.html"; 
        </script>';
    }
}

// Fermeture de la connexion
$conn->close();
?>
