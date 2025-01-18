// Suppression de film par son nom
document.getElementById('removeFilmButton').addEventListener('click', function () {
    const filmToRemove = document.getElementById('filmToRemove').value.trim();

    if (filmToRemove) {
        fetch('remove_film.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name: filmToRemove })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Film supprimé avec succès.');
                // Retirer la carte de la liste
                const cards = document.querySelectorAll('.card');
                cards.forEach(card => {
                    const filmName = card.querySelector('h1').innerText;
                    if (filmName === filmToRemove) {
                        card.remove();
                    }
                });
            } else {
                alert('Film non trouvé.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    } else {
        alert('Veuillez entrer le nom du film à supprimer.');
    }
    resetForm();
    loadFilms();
});

// document.getElementById('addFilmButton').addEventListener('click', function() {
//     let name = document.getElementById('name').value;
//     let image = document.getElementById('image').value;
//     let description = document.getElementById('description').value;

//     if (name && image && description) {
//         fetch('add_film.php', {
//             method: 'POST',
//             body: JSON.stringify({ name, image, description }),
//             headers: { 'Content-Type': 'application/json' }
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 alert('Film ajouté!');
//                 loadFilms(); // Recharger la liste des films
//             } else {
//                 alert('Erreur lors de l\'ajout du film.');
//             }
//         });
//     } else {
//         alert('Veuillez remplir tous les champs.');
//     }
//     loadFilms();
// });



// Fonction pour insérer les données dans le formulaire lors de l'édition
function editFilm(filmId, filmName, filmDescription, filmImage) {
    // Remplir les champs de texte
    document.getElementById('filmId').value = filmId;
    document.getElementById('name').value = filmName;
    document.getElementById('description').value = filmDescription;
    // Remplir le texte indicatif pour l'image (non modifiable dans un <input type="file">)
    document.getElementById('addFilmButton').innerText = "Modifier le Film";
    document.getElementById('addmod').innerText = "Modifier un Film";
    
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}



// Ajouter ou modifier un film
document.getElementById('addFilmButton').addEventListener('click', function () {
    let name = document.getElementById('name').value.trim();
    let description = document.getElementById('description').value.trim();
    let imageFile = document.getElementById('image').files[0]; // Récupérer le fichier
    const filmId = document.getElementById('filmId').value;

    if (name && description) {
        const formData = new FormData();
        formData.append('name', name);
        formData.append('description', description);
        if (imageFile) formData.append('image', imageFile);
        if (filmId) formData.append('id', filmId);

        const url = filmId ? 'update_film.php' : 'add_film.php'; // Déterminer le mode (ajout/modification)

        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(filmId ? "Film modifié avec succès !" : "Film ajouté !");
                    loadFilms(); // Recharger la liste des films
                    resetForm(); // Réinitialiser le formulaire
                } else {
                    alert("Erreur : " + data.error);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert("Une erreur est survenue.");
            });
    } else {
        alert('Veuillez remplir tous les champs.');
    }
});





// Fonction pour réinitialiser le formulaire
function resetForm() {
    document.getElementById('name').value = '';
    document.getElementById('image').value = '';
    document.getElementById('description').value = '';
    document.getElementById('filmId').value = '';  // Effacer l'ID pour éviter une modification accidentelle
    document.getElementById('addFilmButton').innerText = "Ajouter le Film";  // Réinitialiser le texte du bouton
    document.getElementById('addmod').innerText = "Ajouter un Film"; 
    document.getElementById('filmToRemove').value = '';
}






// Exemple de chargement des films avec option de modification
// Fonction pour charger les films depuis la base de données
function loadFilms() {
    fetch('get_film.php')  // Ce fichier récupère les films depuis la base de données
        .then(response => response.json())
        .then(films => {
            const filmListContainer = document.getElementById('filmList');
            filmListContainer.innerHTML = '';  // Réinitialiser la liste des films
            films.forEach(film => {
                const filmCard = document.createElement('div');
                filmCard.classList.add('card');
                filmCard.innerHTML = `
                <img src="${film.chemin}" alt="${film.nom}">
                    <div class="details">
                        <h2>${film.nom}</h2>
                        <p>${film.description}</p>
                        <button id="modifier" onclick="editFilm(${film.id}, '${film.nom}', '${film.description}')">Modifier</button>
                    </div>
                `;
                filmListContainer.appendChild(filmCard);
            });
        })
        .catch(error => console.error('Erreur:', error));
}
// Appeler la fonction de chargement des films au démarrage
loadFilms();


const scrollToTopBtn = document.getElementById('scrollToTopBtn');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollToTopBtn.classList.add('show');
    } else {
        scrollToTopBtn.classList.remove('show');
    }
});

scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// document.getElementById('form-toggle').addEventListener('change', (e) => {
//     if (e.target.checked) {
//       document.getElementById('addFilmForm').reset();
//     } else {
//       document.getElementById('removeFilmForm').reset();
//     }
//   });
  