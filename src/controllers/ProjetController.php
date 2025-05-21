<?php
include_once 'config/Database.php';
include_once 'models/Projet.php';
include_once 'models/Salarie.php';

class ProjetController {
    private $projet;
    private $salarie;
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->projet = new Projet($this->db);
        $this->salarie = new Salarie($this->db);
    }
    
    // Afficher la liste des projets
    public function index() {
        $stmt = $this->projet->read();
        $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once 'views/projet/index.php';
    }
    
    // Afficher le formulaire de création
    public function create() {
        // Récupérer la liste des salarés pour le select
        $stmt = $this->salarie->read();
        $salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->projet->salarie_id = htmlspecialchars(strip_tags($_POST['salarie_id']));
            $this->projet->nom_projet = htmlspecialchars(strip_tags($_POST['nom_projet']));
            $this->projet->objectif = htmlspecialchars(strip_tags($_POST['objectif']));
            $this->projet->date_debut = htmlspecialchars(strip_tags($_POST['date_debut']));
            $this->projet->date_fin = htmlspecialchars(strip_tags($_POST['date_fin']));
            
            // Créer le projet
            if($this->projet->create()) {
                header('Location: projet.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la création du projet.";
            }
        }
        
        include_once 'views/projet/create.php';
    }
    
    // Afficher les détails d'un projet
    public function show($id) {
        $this->projet->id = $id;
        if($this->projet->readOne()) {
            include_once 'views/projet/show.php';
        } else {
            echo "Projet non trouvé.";
        }
    }
    
    // Afficher et traiter le formulaire de modification
    public function edit($id) {
        $this->projet->id = $id;
        
        // Récupérer la liste des salariés pour le select
        $stmt = $this->salarie->read();
        $salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->projet->salarie_id = htmlspecialchars(strip_tags($_POST['salarie_id']));
            $this->projet->nom_projet = htmlspecialchars(strip_tags($_POST['nom_projet']));
            $this->projet->objectif = htmlspecialchars(strip_tags($_POST['objectif']));
            $this->projet->date_debut = htmlspecialchars(strip_tags($_POST['date_debut']));
            $this->projet->date_fin = htmlspecialchars(strip_tags($_POST['date_fin']));
            
            // Mettre à jour le projet
            if($this->projet->update()) {
                header('Location: projet.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour du projet.";
            }
        } else {
            // Charger les données du projet
            if(!$this->projet->readOne()) {
                echo "Projet non trouvé.";
                return;
            }
        }
        
        include_once 'views/projet/edit.php';
    }
    
    // Supprimer un projet
    public function delete($id) {
        $this->projet->id = $id;
        
        if($this->projet->delete()) {
            header('Location: projet.php');
            exit;
        } else {
            echo "Une erreur est survenue lors de la suppression du projet.";
        }
    }
}