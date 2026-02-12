-- Création de la base de données
CREATE DATABASE takalo;
USE takalo;

-- Table utilisateurs
CREATE TABLE Utilisateur_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table catégories
CREATE TABLE Categorie_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(100) NOT NULL UNIQUE
);

-- Table objets
CREATE TABLE Objet_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT NOT NULL,
    id_categorie INT NOT NULL,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    prix_estimatif DECIMAL(10,2),
    statut ENUM('disponible', 'echange_en_cours', 'echange') DEFAULT 'disponible',
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur_takalo(id),
    FOREIGN KEY (id_categorie) REFERENCES Categorie_takalo(id)
);

-- Table photos
CREATE TABLE PhotoObjet_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT NOT NULL,
    chemin_photo VARCHAR(500) NOT NULL,
    est_principale BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_objet) REFERENCES Objet_takalo(id)
);

-- Table échanges
CREATE TABLE Echange_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_objet1 INT NOT NULL,
    id_objet2 INT NOT NULL,
    id_user1 INT NOT NULL,
    id_user2 INT NOT NULL,
    date_proposition TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en attente', 'accepté', 'refusé') DEFAULT 'en attente',
    FOREIGN KEY (id_objet1) REFERENCES Objet_takalo(id),
    FOREIGN KEY (id_objet2) REFERENCES Objet_takalo(id),
    FOREIGN KEY (id_user1) REFERENCES Utilisateur_takalo(id),
    FOREIGN KEY (id_user2) REFERENCES Utilisateur_takalo(id)
);

-- INSERTIONS -------------------------------------------------

-- 3 utilisateurs
INSERT INTO Utilisateur_takalo (nom, email, mot_de_passe) VALUES
('test1', 'test1@email.com', 'mdp1'),
('test2', 'test2@email.com', 'mdp2'),
('test3', 'test3@email.com', 'mdp3');

-- 5 catégories
INSERT INTO Categorie_takalo (nom_categorie) VALUES
('Vêtements'),
('Livres'),
('DVD'),
('Jeux vidéo'),
('Informatique');

-- 10 objets (chemins images selon arborescence Projet-Takalo/public/assets/image/)
INSERT INTO Objet_takalo (id_utilisateur, id_categorie, titre, description, prix_estimatif, statut) VALUES
(1, 2, 'Le Petit Prince', 'Livre en bon état', 10.00, 'disponible'),
(1, 3, 'Inception', 'DVD original', 8.00, 'disponible'),
(1, 1, 'Jean bleu', 'Taille 40, jamais porté', 25.00, 'echange_en_cours'),
(2, 4, 'Mario Kart', 'Switch, complet', 30.00, 'disponible'),
(2, 5, 'Souris gaming', 'Razer, RGB', 20.00, 'disponible'),
(2, 2, '1984', 'George Orwell', 7.00, 'disponible'),
(3, 1, 'Veste en cuir', 'Taille M, noir', 50.00, 'disponible'),
(3, 5, 'Clavier', 'Mécanique, Logitech', 45.00, 'disponible'),
(3, 4, 'FIFA 24', 'PS5, neuf', 35.00, 'disponible'),
(1, 3, 'Interstellar', 'Blu-ray', 12.00, 'disponible');

-- 10 photos (avec chemins correspondant à l'arborescence)
INSERT INTO PhotoObjet_takalo (id_objet, chemin_photo, est_principale) VALUES
(1, '/Projet-Takalo/public/assets/image/petit_prince.jpg', TRUE),
(2, '/Projet-Takalo/public/assets/image/inception.jpg', TRUE),
(3, '/Projet-Takalo/public/assets/image/jean_bleu.jpg', TRUE),
(4, '/Projet-Takalo/public/assets/image/mario_kart.jpg', TRUE),
(5, '/Projet-Takalo/public/assets/image/souris.jpg', TRUE),
(6, '/Projet-Takalo/public/assets/image/1984.jpg', TRUE),
(7, '/Projet-Takalo/public/assets/image/veste_cuir.jpg', TRUE),
(8, '/Projet-Takalo/public/assets/image/clavier.jpg', TRUE),
(9, '/Projet-Takalo/public/assets/image/fifa24.jpg', TRUE),
(10, '/Projet-Takalo/public/assets/image/interstellar.jpg', TRUE);

-- Propositions d'échange
INSERT INTO Echange_takalo (id_objet1, id_objet2, id_user1, id_user2, statut) VALUES
(1, 6, 1, 2, 'accepté'),   
(3, 7, 1, 3, 'en attente'),    
(4, 9, 2, 3, 'refusé'),  
(5, 8, 2, 3, 'en attente'),  
(10, 2, 1, 1, 'en attente'); 

-- SELECTS -------------------------------------------------

-- 1. Tous les utilisateurs
SELECT * FROM Utilisateur_takalo;

-- 2. Toutes les catégories
SELECT * FROM Categorie_takalo;

-- 3. Tous les objets avec utilisateur et catégorie
SELECT o.id, o.titre, u.nom AS proprietaire, c.nom_categorie, o.prix_estimatif, o.statut
FROM Objet_takalo o
JOIN Utilisateur_takalo u ON o.id_utilisateur = u.id
JOIN Categorie_takalo c ON o.id_categorie = c.id;

-- 4. Toutes les photos avec leurs objets
SELECT p.chemin_photo, o.titre, p.est_principale
FROM PhotoObjet_takalo p
JOIN Objet_takalo o ON p.id_objet = o.id;

-- 5. Tous les échanges
SELECT e.id, u1.nom AS demandeur, o1.titre AS objet_propose, 
       u2.nom AS proprietaire, o2.titre AS objet_demande, e.statut
FROM Echange_takalo e
JOIN Utilisateur_takalo u1 ON e.id_user1 = u1.id
JOIN Utilisateur_takalo u2 ON e.id_user2 = u2.id
JOIN Objet_takalo o1 ON e.id_objet1 = o1.id
JOIN Objet_takalo o2 ON e.id_objet2 = o2.id;

-- 6. Objets disponibles
SELECT titre, prix_estimatif FROM Objet_takalo WHERE statut = 'disponible';

-- 7. Objets par utilisateur
SELECT u.nom, COUNT(o.id) AS nb_objets
FROM Utilisateur_takalo u
LEFT JOIN Objet_takalo o ON u.id = o.id_utilisateur
GROUP BY u.id;

-- 8. Échanges en attente
SELECT * FROM Echange_takalo WHERE statut = 'en attente';

-- 9. Objets avec leur photo principale
SELECT o.titre, p.chemin_photo
FROM Objet_takalo o
JOIN PhotoObjet_takalo p ON o.id = p.id_objet
WHERE p.est_principale = TRUE;

-- 10. Statistiques rapides
SELECT 'Total objets' AS '', COUNT(*) FROM Objet_takalo
UNION
SELECT 'Objets disponibles', COUNT(*) FROM Objet_takalo WHERE statut = 'disponible'
UNION
SELECT 'Échanges en attente', COUNT(*) FROM Echange_takalo WHERE statut = 'en attente';