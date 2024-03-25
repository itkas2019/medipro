<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$serveur = "localhost";
$user = "root";
$pwd = "";
$dbname = "medipro";

$connexion = new mysqli($serveur, $user, $pwd, $dbname);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

// Récupération des données du formulaire
$id = $_POST['id'];
$date = $_POST['date'];
$heure = $_POST['heure'];

// Formater l'heure pour ne garder que l'heure et les minutes
$heure_formattee = date("H:i", strtotime($heure));

// Requête SQL pour mettre à jour le rendez-vous
$sql = "UPDATE tb_rdv SET date_rdv='$date', heure_rdv='$heure_formattee' WHERE id=$id";

if ($connexion->query($sql) === TRUE) {
    echo "Mise à jour du rendez-vous avec succès.";
    
} else {
    echo "Erreur lors de la mise à jour du rendez-vous: " . $connexion->error;
}

// Fermeture de la connexion
$connexion->close();
?>
