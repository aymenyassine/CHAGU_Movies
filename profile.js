document.addEventListener("DOMContentLoaded", () => {
    // Charger les données du profil de l'utilisateur
    fetch("get_profile.php")
        .then(response => response.json())
        .then(data => {
            // Injecter les données dans la page HTML
            document.getElementById("profileImage").src = data.photo;
            document.getElementById("username").textContent = data.nom;
            document.getElementById("email").textContent = data.email;
            document.getElementById("favoriteMovies").textContent = data.favorite_movies || "Non spécifié";
        })
        .catch(error => {
            console.error("Erreur lors du chargement des données :", error);
        });

    // Gestion des boutons de modification
    document.getElementById("editUsernameButton").addEventListener("click", () => {
        document.getElementById("userInfo").style.display = "none";
        document.getElementById("editUsernameForm").style.display = "block";
        document.getElementById("editPasswordForm").style.display = "none";
    });

    document.getElementById("editPasswordButton").addEventListener("click", () => {
        document.getElementById("userInfo").style.display = "none";
        document.getElementById("editUsernameForm").style.display = "none";
        document.getElementById("editPasswordForm").style.display = "block";
    });

    // Gestion des formulaires de modification
    document.getElementById("usernameForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch("update_profile.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            location.reload();
        })
        .catch(error => {
            console.error("Erreur lors de la mise à jour du profil:", error);
        });
    });

    document.getElementById("passwordForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch("update_profile.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            location.reload();
        })
        .catch(error => {
            console.error("Erreur lors de la mise à jour du profil:", error);
        });
    });
});




document.addEventListener("DOMContentLoaded", function() {
    // Sélectionner le formulaire pour le téléchargement de la photo
    const profileForm = document.querySelector("form"); // Assurez-vous que vous avez un formulaire <form> pour la photo

    // Écouter la soumission du formulaire
    profileForm.addEventListener("submit", function(e) {
        e.preventDefault(); // Empêcher la soumission du formulaire classique

        const formData = new FormData(profileForm); // Créer un objet FormData à partir du formulaire

        // Envoi de la requête POST via fetch
        fetch("upload_profile.php", {
            method: "POST",
            body: formData // Envoyer les données du formulaire (y compris la photo)
        })
        .then(response => response.json()) // Traiter la réponse JSON
        .then(data => {
            if (data.success) {
                alert(data.message); // Afficher un message de succès
                location.reload(); // Recharger la page pour afficher la photo mise à jour
            } else {
                alert("Erreur : " + (data.error || "Une erreur est survenue.")); // Afficher un message d'erreur
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi de la photo : ", error);
            alert("Une erreur est survenue. Veuillez réessayer.");
        });
    });
});




// cacher les form


document.getElementById('changeProfileButton').addEventListener('click', function() {
    var profileForm = document.getElementById('profileForm');
    var usernameForm = document.getElementById('usernameForm');
    
    // Cacher le formulaire de changement de nom d'utilisateur s'il est visible
    if (usernameForm.style.display === 'block') {
        usernameForm.style.display = 'none';
    }

    // Afficher ou masquer le formulaire de changement de photo
    if (profileForm.style.display === 'none' || profileForm.style.display === '') {
        profileForm.style.display = 'block';
    } else {
        profileForm.style.display = 'none';
    }
});

document.getElementById('changeUsernameButton').addEventListener('click', function() {
    var profileForm = document.getElementById('profileForm');
    var usernameForm = document.getElementById('usernameForm');
    
    // Cacher le formulaire de changement de photo de profil s'il est visible
    if (profileForm.style.display === 'block') {
        profileForm.style.display = 'none';
    }

    // Afficher ou masquer le formulaire de changement de nom d'utilisateur
    if (usernameForm.style.display === 'none' || usernameForm.style.display === '') {
        usernameForm.style.display = 'block';
    } else {
        usernameForm.style.display = 'none';
    }
});
