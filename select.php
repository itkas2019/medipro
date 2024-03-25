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
echo "<a href='espace_collabo.html'>Retour</a>";
// Si le formulaire de suppression est soumis
if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    // Requête de suppression
    $sql_delete = "DELETE FROM tb_rdv WHERE ID = $delete_id";
    if ($connexion->query($sql_delete) === TRUE) {
        echo '<script>alert("La suppression effectué avec succès.");</script>';
    } else {
        echo "Error deleting record: " . $connexion->error;
    }
}

// Sélection des colonnes spécifiques
$sql = "SELECT ID, genre, nom, prenom, email, etat_civil, date_rdv, heure_rdv, medecin, motif FROM tb_rdv";
$result = $connexion->query($sql);

echo "<html><head><style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    .action-buttons {
        text-align: center;
    }
</style></head><body>";

if ($result->num_rows > 0) {
    // Affichage des données dans un tableau
    echo "<table><tr><th>ID</th><th>Genre</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Etat Civil</th><th>Date de RDV</th><th>Heure de RDV</th><th>Medecin</th><th>Motif</th><th>Actions</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["email"] . "</td><td>" . $row["etat_civil"] . "</td><td>" . $row["date_rdv"] . "</td><td>" . $row["heure_rdv"] . "</td><td>" . $row["medecin"] . "</td><td>" . $row["motif"] . "</td><td class='action-buttons'><form method='post'><input type='hidden' name='delete_id' value='" . $row["ID"] . "'><button type='submit'>Delete</button></form></td></tr>";
    }

    echo "</table>";
} else {
    echo "No data found";
}



echo "</body></html>";

$connexion->close();
?>
