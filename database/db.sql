CREATE DATABASE takalo;
USE takalo;

-- Table des utilisateurs
CREATE TABLE Utilisateur_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories
CREATE TABLE Categorie_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

-- Table des objets
CREATE TABLE Objet_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT NOT NULL,
    id_categorie INT NOT NULL,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    prix_estimatif DECIMAL(10,2),
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('disponible', 'echange_en_cours', 'echange') DEFAULT 'disponible',
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur_takalo(id) ON DELETE CASCADE,
    FOREIGN KEY (id_categorie) REFERENCES Categorie_takalo(id) ON DELETE RESTRICT
);

-- Table des photos d'objets
CREATE TABLE PhotoObjet_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT NOT NULL,
    chemin_photo VARCHAR(500) NOT NULL,
    est_principale BOOLEAN DEFAULT FALSE,
    date_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_objet) REFERENCES Objet_takalo(id) ON DELETE CASCADE
);

-- Table des échanges
CREATE TABLE Echange_takalo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_objet1 INT NOT NULL,
    id_objet2 INT NOT NULL,
    id_user1 INT NOT NULL,
    id_user2 INT NOT NULL,
    date_proposition TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en attente', 'accepté', 'refusé') DEFAULT 'en attente',
    FOREIGN KEY (id_objet1) REFERENCES Objet_takalo(id) ON DELETE CASCADE,
    FOREIGN KEY (id_objet2) REFERENCES Objet_takalo(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user1) REFERENCES Utilisateur_takalo(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user2) REFERENCES Utilisateur_takalo(id) ON DELETE CASCADE
);