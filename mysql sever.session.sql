-- SELECT * from images;
-- SELECT * from images;

-- INSERT INTO images (chemin, nom) VALUES
-- ('img/pster/images (14).jpeg', 'Image 41'),
-- ('img/pster/images (15).jpeg', 'Image 42'),
-- ('img/pster/images (16).jpeg', 'Image 43'),
-- ('img/pster/images.jpeg', 'Image 44'),
-- ('img/pster/téléchargement (1).jpeg', 'Image 12'),
-- ('img/pster/téléchargement (2).jpeg', 'Image 13'),
-- ('img/pster/téléchargement (3).jpeg', 'Image 14'),
-- ('img/pster/téléchargement (4).jpeg', 'Image 15'),
-- ('img/pster/téléchargement (5).jpeg', 'Image 16'),
-- ('img/pster/téléchargement (6).jpeg', 'Image 17'),
-- ('img/pster/téléchargement (7).jpeg', 'Image 18'),
-- ('img/pster/téléchargement (8).jpeg', 'Image 19'),
-- ('img/pster/téléchargement (9).jpeg', 'Image 20'),
-- ('img/pster/téléchargement (10).jpeg', 'Image 21'),
-- ('img/pster/téléchargement (12).jpeg', 'Image 22'),
-- ('img/pster/téléchargement (13).jpeg', 'Image 23'),
-- ('img/pster/téléchargement (14).jpeg', 'Image 24'),
-- ('img/pster/téléchargement (15).jpeg', 'Image 25'),
-- ('img/pster/téléchargement (11).jpeg', 'Image 26'),
-- ('img/pster/téléchargement (16).jpeg', 'Image 27'),
-- ('img/pster/téléchargement (17).jpeg', 'Image 28'),
-- ('img/pster/téléchargement (18).jpeg', 'Image 29'),
-- ('img/pster/téléchargement (19).jpeg', 'Image 30'),
-- ('img/pster/téléchargement (20).jpeg', 'Image 31'),
-- ('img/pster/téléchargement (23).jpeg', 'Image 32'),
-- ('img/pster/téléchargement (24).jpeg', 'Image 33'),
-- ('img/pster/téléchargement (25).jpeg', 'Image 34'),
-- ('img/pster/téléchargement (21).jpeg', 'Image 35'),
-- ('img/pster/téléchargement (22).jpeg', 'Image 36'),
-- ('img/pster/téléchargement (26).jpeg', 'Image 37'),
-- ('img/pster/téléchargement (27).jpeg', 'Image 38'),
-- ('img/pster/téléchargement (28).jpeg', 'Image 39'),
-- ('img/pster/téléchargement (29).jpeg', 'Image 40');

-- UPDATE images SET description = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis itaque, ab harum, ducimus sed, temporibus doloremque consequuntur amet asperiores a reprehenderit voluptatem omnis magni repellendus praesentium deserunt nemo odio quam!';

-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique pour chaque utilisateur
--     nom VARCHAR(255) NOT NULL, -- Nom de l'utilisateur
--     numero_de_telephone VARCHAR(15), -- Numéro de téléphone de l'utilisateur (format texte pour inclure des préfixes internationaux)
--     email VARCHAR(255) NOT NULL UNIQUE, -- Email, avec contrainte d'unicité
--     password VARCHAR(255) NOT NULL -- Mot de passe haché
-- );

-- select * from users;
-- drop TABLE users



-- CREATE TABLE images (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nom VARCHAR(255) NOT NULL,
--     chemin VARCHAR(255) NOT NULL
-- );

-- CREATE TABLE commentaires (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Identifiant unique pour chaque commentaire
--     image_id INT NOT NULL,              -- Identifiant de l'image associée
--     commentaire TEXT NOT NULL,          -- Contenu du commentaire
--     date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,  -- Date et heure de création
--     FOREIGN KEY (image_id) REFERENCES images(id)       -- Clé étrangère pour associer avec le tableau `images`
-- );
-- ALTER TABLE commentaires
-- ADD auteur VARCHAR(255) NOT NULL AFTER commentaire,  -- Ajouter la colonne `auteur`


-- ALTER TABLE commentaires DROP COLUMN note;

-- DROP table commentaires
-- UPDATE images
-- SET description = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis itaque, ab harum, ducimus sed, temporibus doloremque consequuntur amet asperiores a reprehenderit voluptatem omnis magni repellendus praesentium deserunt nemo odio quam!';



-- Répétez pour les autres images...



-- DELETE FROM images ;



    -- SELECT * FROM images;


-- SELECT * FROM commentaires WHERE image_id = 55;


-- DELETE FROM commentaires WHERE image_id = 55;

-- SELECT * FROM images WHERE nom = "Titanic"


-- UPDATE images
-- SET description = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis itaque, ab harum, ducimus sed, temporibus doloremque consequuntur amet asperiores a reprehenderit voluptatem omnis magni repellendus praesentium deserunt nemo odio quam!'
-- WHERE nom = "Star wars";


-- SELECT * FROM users


-- ALTER TABLE users
-- MODIFY status ENUM('Actif', 'Inactif', 'Banni') DEFAULT 'Actif';



-- ALTER TABLE users
-- ADD attempts INT DEFAULT 0,
-- ADD banned_until DATETIME NULL;
-- ALTER TABLE users
-- ADD photo VARCHAR(255) NOT NULL DEFAULT 'img/profile/profile_default.jpg'


select * from users

-- UPDATE users 
--  set banned_until = NULL
