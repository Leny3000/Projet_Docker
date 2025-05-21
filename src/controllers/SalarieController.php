<?php
include_once 'config/Database.php';
include_once 'models/Salarie.php';

class SalarieController {
    private $salarie;
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->salarie = new Salarie($this->db);
    }
    
    // Afficher la liste des salariés
    public function index() {
        $stmt = $this->salarie->read();
        $salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once 'views/salarie/index.php';
    }
    
    // Afficher le formulaire de création
    public function create() {
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->salarie->nom = htmlspecialchars(strip_tags($_POST['nom']));
            $this->salarie->prenom = htmlspecialchars(strip_tags($_POST['prenom']));
            $this->salarie->email = htmlspecialchars(strip_tags($_POST['email']));
            $this->salarie->role = htmlspecialchars(strip_tags($_POST['role']));
            $this->salarie->date_inscription = htmlspecialchars(strip_tags($_POST['date_inscription']));
            
            // Créer le salarié
            if($this->salarie->create()) {
                header('Location: salarie.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la création du client.";
            }
        }
        
        include_once 'views/salarie/create.php';
    }
    
    // Afficher les détails d'un salarié
    public function show($id) {
        $this->salarie->id = $id;
        if($this->salarie->readOne()) {
            include_once 'views/salarie/show.php';
        } else {
            echo "Salarié non trouvé.";
        }
    }
    
    // Afficher et traiter le formulaire de modification
    public function edit($id) {
        $this->salarie->id = $id;
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->salarie->nom = htmlspecialchars(strip_tags($_POST['nom']));
            $this->salarie->prenom = htmlspecialchars(strip_tags($_POST['prenom']));
            $this->salarie->email = htmlspecialchars(strip_tags($_POST['email']));
            $this->salarie->role = htmlspecialchars(strip_tags($_POST['role']));
            $this->salarie->date_inscription = htmlspecialchars(strip_tags($_POST['date_inscription']));
            
            // Mettre à jour le salarié
            if($this->salarie->update()) {
                header('Location: salarie.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour du salarié.";
            }
        } else {
            // Charger les données du salarié
            if(!$this->salarie->readOne()) {
                echo "Salarié non trouvé.";
                return;
            }
        }
        
        include_once 'views/salarie/edit.php';
    }
    
    // Supprimer un salarié
    public function delete($id) {
        $this->salarie->id = $id;
        
        if($this->salarie->delete()) {
            header('Location: salarie.php');
            exit;
        } else {
            echo "Une erreur est survenue lors de la suppression du salarié.";
        }
    }
}