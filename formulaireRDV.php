<?php
// Assurez-vous de configurer ces informations en fonction de votre base de données
$server = "localhost";
$user = "root";
$pwd = " ";
$dbname = "medipro";

// Création de la connexion
$conn = new mysqli($server, $user, $pwd, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}


// Récupération des données du formulaire
$genre = $_POST['genre'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$etat_civil = $_POST['etat_civil'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$medecin = $_POST['medecin'];
$motif = $_POST['motif'];

// Vérification des doublons
$doublonSql = "SELECT * FROM tb_rdv WHERE date_rdv = '$date' AND heure_rdv = '$heure' AND medecin = '$medecin'";
$doublonResult = $conn->query($doublonSql);

if ($doublonResult->num_rows > 0) {
    // Afficher une alerte avec JavaScript
    echo '<script>alert("Le rendez-vous pour la date, l\'heure et le médecin sélectionnés existe déjà. Veuillez choisir une autre date, heure ou médecin."); window.location.href = "index.html";</script>';
} else {
    // Insertion des données dans la base de données
    $sql = "INSERT INTO tb_rdv (genre, nom, prenom, email, etat_civil, date_rdv, heure_rdv, medecin, motif) VALUES ('$genre', '$nom', '$prenom', '$email', '$etat_civil', '$date', '$heure', '$medecin', '$motif')";

    if ($conn->query($sql) === TRUE) {
        // Afficher une alerte avec JavaScript
        echo '<script>alert("Votre rendez-vous a été pris avec succès. Nos services vous contacteront dans les 24 heures pour confirmer. Merci à bientôt"); window.location.href = "index.html";</script>';
    } else {
        // Afficher une alerte avec JavaScript
        echo '<script>alert("Erreur lors de la prise de rendez-vous."); window.location.href = "index.html";</script>';
    }
}

// Fermeture de la connexion
$conn->close();
?>
