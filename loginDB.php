<?php
// Connexion à la base de données MySQL
$servername = "localhost";
$user = "root";
$pwd = "";
$dbname = "medipro";

$conn = new mysqli($servername, $user, $pwd, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("La connexion a échoué: " . $conn->connect_error);
}

// Récupération des données du formulaire
$nom_login = $_POST['nom_login'];
$mot_de_passe_login = $_POST['mot_de_passe_login'];

// Requête de récupération du mot de passe haché
$sql = "SELECT mot_de_passe FROM tb_compte WHERE nom ='$nom_login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Récupérer le mot de passe haché de la base de données
  $row = $result->fetch_assoc();
  $mot_de_passe_hache = $row['mot_de_passe'];

  // Vérifier si le mot de passe saisi correspond au mot de passe haché
  if (password_verify($mot_de_passe_login, $mot_de_passe_hache)) {

    echo '<script>alert("Connexion réussie. Bienvenue, ' . htmlspecialchars($nom_login) . '!"); 
    window.location.href="espace_collabo.html";</script>';

  } else {
    echo '<script>alert("Mot de passe incorrect."); 
            window.history.back();</script>';
  }
} else {
  echo '<script>alert("Mot de passe ou nom incorrect."); 
            window.history.back();</script>';
}

// Fermer la connexion à la base de données
$conn->close();
?>
