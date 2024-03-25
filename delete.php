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
// Delete data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteID = $_POST["id"];

    $sql = "DELETE FROM tb_rdv WHERE id = '$deleteID'";

    if ($connexion->query($sql) === TRUE) 
      // JavaScript code to display an alert
      echo '<script>alert("La suppression a été effectuée avec succès");</script>;
      window.history.back();</script>';
    else {
        echo "Error: " . $sql . "<br>" . $connexion->error;
    }
}

$connexion->close();
?>