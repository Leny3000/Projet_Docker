-- Création des tables
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE,
    date_inscription DATE
);

CREATE TABLE IF NOT EXISTS commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    date_commande DATETIME,
    montant DECIMAL(10, 2),
    statut VARCHAR(50),
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- Insertion de données de test
INSERT INTO clients (nom, prenom, email, date_inscription) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', '2023-01-15'),
('Martin', 'Sophie', 'sophie.martin@email.com', '2023-02-20'),
('Dubois', 'Pierre', 'pierre.dubois@email.com', '2023-03-10'),
('Lefebvre', 'Marie', 'marie.lefebvre@email.com', '2023-04-05');

INSERT INTO commandes (client_id, date_commande, montant, statut) VALUES
(1, '2023-05-10 14:30:00', 125.50, 'Livrée'),
(2, '2023-05-12 09:15:00', 89.90, 'En cours'),
(1, '2023-05-15 16:45:00', 45.20, 'En préparation'),
(3, '2023-05-18 11:20:00', 210.75, 'Livrée'),
(4, '2023-05-20 13:10:00', 65.30, 'En cours');