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
$nom = $_POST['nom'];
$mot_de_passe = $_POST['mot_de_passe'];

// Vérifier si le nom existe déjà dans la base de données
$sql_check = "SELECT * FROM tb_compte WHERE nom ='$nom'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
  echo '<script>alert("Ce nom existe déjà."); 
            window.history.back();</script>';
  
} else {
  // Hashage du mot de passe
  $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

  // Requête d'insertion des données dans la table utilisateurs
  $sql_insert = "INSERT INTO tb_compte(nom, mot_de_passe) VALUES ('$nom', '$mot_de_passe_hash')";

  if ($conn->query($sql_insert) === TRUE) {
 
    echo '<script>alert("Inscription réussie. Vous pouvez maintenant vous connecter."); 
            window.history.back();     
            </script>';
  } else {
    echo "Erreur lors de l'inscription: " . $conn->error;
  }
}

// Fermer la connexion à la base de données
$conn->close();
?>

