<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$serveur = "localhost";
$user = "root";
$pwd = "";
$dbname = "medipro";

$connexion = new mysqli($serveur, $user, $pwd, $dbname);
// Check connection
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

// Search data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];

    $sql = "SELECT ID, genre, nom, prenom, email, etat_civil, date_rdv, heure_rdv, medecin, motif FROM tb_rdv WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR email LIKE '%$search%' OR medecin LIKE '%$search%' OR motif LIKE '%$search%'";
    
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
</style></head><body>";

    if ($result->num_rows > 0) {
        // Output data in a table
        echo "<table><tr><th>ID</th><th>Genre</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Etat Civil</th><th>Date de RDV</th><th>Heure de RDV</th><th>Medecin</th><th>Motif</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["email"] . "</td><td>" . $row["etat_civil"] . "</td><td>" . $row["date_rdv"] . "</td><td>" . $row["heure_rdv"] . "</td><td>" . $row["medecin"] . "</td><td>" . $row["motif"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "No matching data found";
    }

    echo "</body></html>";
}

$connexion->close();
?>