document.addEventListener("DOMContentLoaded", () => {
    function getFilmIdFromUrl() {
        const params = new URLSearchParams(window.location.search);
        return params.get('id'); // Récupère l'ID du film de l'URL
    }

    function loadFilmById(id) {
        fetch(`show.php?id=${id}`)
            .then(response => response.json())
            .then(film => {
                const filmContainer = document.getElementById('film-details');
                filmContainer.innerHTML = '';

                if (film && !film.error) {
                    const titleElement = document.getElementById('titre-page');
                    titleElement.textContent = film.nom; // Mettre le nom du film dans le titre de la page
                    const filmDetails = `
                        <div class="film-container">
                            <div class="film-content">
                                <h1 class="film-title">${film.nom}</h1>
                                <p class="film-description">${film.description}</p>
                                <a href="#"><button class="watch-now">Watch Now</button></a>
                            </div>
                            <div class="film-image">
                                <img src="${film.chemin}" alt="${film.nom}">
                            </div>
                        </div>
                    `;
                    filmContainer.innerHTML = filmDetails;

                    // Remplir l'ID de l'image dans le champ caché
                    document.getElementById('image_id').value = id; // Assurez-vous que l'ID est inséré ici
                } else {
                    filmContainer.innerHTML = `<p>Film non trouvé ou erreur: ${film.error}</p>`;
                }

                // Charger les commentaires du film
                loadCommentsByFilmId(id);
            })
            .catch(error => console.error('Erreur lors du chargement du film :', error));
    }

    function loadCommentsByFilmId(id) {
        fetch(`get_comments.php?id=${id}`)
            .then(response => response.json())
            .then(comments => {
                console.log(comments); // Vérifier ce qui est retourné par le serveur
                const commentsContainer = document.getElementById('film-comments');
                commentsContainer.innerHTML = '<h2>Commentaires</h2>';
    
                if (comments.length > 0) {
                    comments.forEach(comment => {
                        const commentElement = `
                            <div class="comment">
                                <p><strong>${comment.auteur}</strong> : ${comment.commentaire}</p>
                                <p class="comment-date">${comment.date_creation}</p>
                            </div>
                        `;
                        commentsContainer.innerHTML += commentElement;
                    });
                } else {
                    commentsContainer.innerHTML += '<p>Aucun commentaire pour ce film.</p>';
                }
            })
            .catch(error => console.error('Erreur lors du chargement des commentaires :', error));
    }
    

    const filmId = getFilmIdFromUrl();
    if (filmId) {
        loadFilmById(filmId); // Charger les détails du film
    } else {
        console.error("Aucun ID spécifié dans l'URL.");
    }

    // Gestion de l'envoi du formulaire
    const form = document.getElementById('comment-form');
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Empêche le rechargement de la page

        const imageId = document.getElementById('image_id').value; // Récupère l'ID de l'image depuis le champ caché
        const texte = document.getElementById('texte').value; // Récupère le texte du commentaire

        // Envoi des données au serveur via fetch
        fetch('add_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `image_id=${encodeURIComponent(imageId)}&texte=${encodeURIComponent(texte)}`,
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert('Commentaire ajouté avec succès.');
                form.reset(); // Réinitialiser le formulaire après envoi
                loadCommentsByFilmId(imageId);
            } else {
                alert(data.message || 'Erreur lors de l\'ajout du commentaire.');
            }
        })
        .catch((error) => console.error('Erreur lors de l\'ajout du commentaire :', error));
    });
});
