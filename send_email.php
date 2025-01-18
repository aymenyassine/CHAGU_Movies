<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $message = htmlspecialchars($_POST['message']);
    
    // Adresse email de destination
    $to = "aymenyassine301@gmail.com";

    // Sujet de l'email
    $subject = "Nouvelle réclamation de $firstName $lastName";

    // Corps de l'email
    $body = "
        <h2>Réclamation Reçue</h2>
        <p><strong>Nom :</strong> $firstName $lastName</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Mobile :</strong> $mobile</p>
        <p><strong>Message :</strong></p>
        <p>$message</p>
    ";

    // En-têtes pour un email HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";

    // Envoyer l'email
    if (mail($to, $subject, $body, $headers)) {
        echo "Votre réclamation a été envoyée avec succès ! Merci.";
    } else {
        echo "Erreur lors de l'envoi. Veuillez réessayer plus tard.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
