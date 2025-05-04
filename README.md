# Projet_Docker

# Application gestion de projets avec Docker PHP/MySQL

Cette application démontre l'utilisation de Docker pour déployer une architecture des projets complète avec PHP et MySQL.

## Structure du projet

- `docker-compose.yml`: Configuration des services Docker
- `docker/`: Fichiers de configuration Docker
  - `php/`: Configuration du conteneur PHP/Apache
  - `mysql/`: Configuration et initialisation MySQL
- `docs/`: Documents du DM
  - `screens/`: captures d'écran du DM
- `src/`: Code source de l'application PHP (architecture MVC)
  - `config/`: Configuration de l'application
  - `controllers/`: Contrôleurs MVC
  - `models/`: Modèles de données
  - `views/`: Templates d'affichage
    - `projet/`: page de la gestion des projets
    - `salarie/`: page et fichiers pour la gestion des salariés

## Prérequis

- Docker
- Docker Compose

## Installation

1. Clonez ce dépôt
2. Lancez les conteneurs avec `docker-compose up -d`
3. Accédez à l'application via `http://localhost:8080`

## Fonctionnalités

- Gestion des salariés (liste, ajout, modification, suppression)
- Gestion des projets (liste, ajout, modification, suppression)
- Relation entre salariés et projets

## Technologies utilisées

- Docker & Docker Compose
- PHP 8.1
- Apache
- MySQL 8.0