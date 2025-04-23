<?php
include_once 'config/database.php';
include_once 'models/Commande.php';
include_once 'models/Client.php';

class CommandeController {
    private $commande;
    private $client;
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->commande = new Commande($this->db);
        $this->client = new Client($this->db);
    }
    
    // Afficher la liste des commandes
    public function index() {
        $stmt = $this->commande->read();
        $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once 'views/commande/index.php';
    }
    
    // Afficher le formulaire de création
    public function create() {
        // Récupérer la liste des clients pour le select
        $stmt = $this->client->read();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->commande->client_id = htmlspecialchars(strip_tags($_POST['client_id']));
            $this->commande->date_commande = htmlspecialchars(strip_tags($_POST['date_commande']));
            $this->commande->montant = htmlspecialchars(strip_tags($_POST['montant']));
            $this->commande->statut = htmlspecialchars(strip_tags($_POST['statut']));
            
            // Créer la commande
            if($this->commande->create()) {
                header('Location: commande.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la création de la commande.";
            }
        }
        
        include_once 'views/commande/create.php';
    }
    
    // Afficher les détails d'une commande
    public function show($id) {
        $this->commande->id = $id;
        if($this->commande->readOne()) {
            include_once 'views/commande/show.php';
        } else {
            echo "Commande non trouvée.";
        }
    }
    
    // Afficher et traiter le formulaire de modification
    public function edit($id) {
        $this->commande->id = $id;
        
        // Récupérer la liste des clients pour le select
        $stmt = $this->client->read();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->commande->client_id = htmlspecialchars(strip_tags($_POST['client_id']));
            $this->commande->date_commande = htmlspecialchars(strip_tags($_POST['date_commande']));
            $this->commande->montant = htmlspecialchars(strip_tags($_POST['montant']));
            $this->commande->statut = htmlspecialchars(strip_tags($_POST['statut']));
            
            // Mettre à jour la commande
            if($this->commande->update()) {
                header('Location: commande.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour de la commande.";
            }
        } else {
            // Charger les données de la commande
            if(!$this->commande->readOne()) {
                echo "Commande non trouvée.";
                return;
            }
        }
        
        include_once 'views/commande/edit.php';
    }
    
    // Supprimer une commande
    public function delete($id) {
        $this->commande->id = $id;
        
        if($this->commande->delete()) {
            header('Location: commande.php');
            exit;
        } else {
            echo "Une erreur est survenue lors de la suppression de la commande.";
        }
    }
}