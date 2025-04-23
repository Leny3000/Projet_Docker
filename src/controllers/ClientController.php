<?php
include_once 'config/database.php';
include_once 'models/Client.php';

class ClientController {
    private $client;
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->client = new Client($this->db);
    }
    
    // Afficher la liste des clients
    public function index() {
        $stmt = $this->client->read();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once 'views/client/index.php';
    }
    
    // Afficher le formulaire de création
    public function create() {
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->client->nom = htmlspecialchars(strip_tags($_POST['nom']));
            $this->client->prenom = htmlspecialchars(strip_tags($_POST['prenom']));
            $this->client->email = htmlspecialchars(strip_tags($_POST['email']));
            $this->client->date_inscription = htmlspecialchars(strip_tags($_POST['date_inscription']));
            
            // Créer le client
            if($this->client->create()) {
                header('Location: client.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la création du client.";
            }
        }
        
        include_once 'views/client/create.php';
    }
    
    // Afficher les détails d'un client
    public function show($id) {
        $this->client->id = $id;
        if($this->client->readOne()) {
            include_once 'views/client/show.php';
        } else {
            echo "Client non trouvé.";
        }
    }
    
    // Afficher et traiter le formulaire de modification
    public function edit($id) {
        $this->client->id = $id;
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->client->nom = htmlspecialchars(strip_tags($_POST['nom']));
            $this->client->prenom = htmlspecialchars(strip_tags($_POST['prenom']));
            $this->client->email = htmlspecialchars(strip_tags($_POST['email']));
            $this->client->date_inscription = htmlspecialchars(strip_tags($_POST['date_inscription']));
            
            // Mettre à jour le client
            if($this->client->update()) {
                header('Location: client.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour du client.";
            }
        } else {
            // Charger les données du client
            if(!$this->client->readOne()) {
                echo "Client non trouvé.";
                return;
            }
        }
        
        include_once 'views/client/edit.php';
    }
    
    // Supprimer un client
    public function delete($id) {
        $this->client->id = $id;
        
        if($this->client->delete()) {
            header('Location: client.php');
            exit;
        } else {
            echo "Une erreur est survenue lors de la suppression du client.";
        }
    }
}