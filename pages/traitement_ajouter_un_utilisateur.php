<?php
session_start();

if(isset($_SESSION['email'])){
function deconnexion() {
    session_unset();
    session_destroy();
    header("location: ../index.php");
    }
 
if(isset ($_POST["btn-deconnexion"])){
    deconnexion();
    }
    ?>
    
    
    <?php
           } else{
        echo"<a href='' class='btn btn-warning'>Se connecter</a>";
        header('Location: ../index.php');
    }
    ?>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><?php require_once "header.php";?></header>
    <?php
        
$user = "root";
$pass = "";
$baseDonnee = "ecommerce";
$hote = "localhost";
try{
    $gestionProduit = new PDO("mysql:host=".$hote.";dbname=".$baseDonnee.";charset=UTF8", $user, $pass);

    $gestionProduit->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert-alert-success'>Vous etes connecté à PDO</p>";
}catch(PDOException $e){
print "erreur ! :" .$e->getMessage() . "</br>";

die();
}

if($gestionProduit){
    $sql = "INSERT INTO `user`(`login_user`, `email`, `password`) VALUES (?,?,?)";
    //Requete préparée = connexion + methode prepare + requete sql
    // Les requetes préparée lutte contre les injections SQL
    //PDO : prepare - Prepare une requete à l'exécution et retourne un objet
    $rajout = $gestionProduit->prepare($sql);
    
    //bindé les paramètre
    //Liés les paramètre du formulaire a la tale phpmyadmin
    //PDOstatement::bindparam - lie un paramètre à un nom d'une variable spécifique
    
    $rajout->bindParam(1, $_POST['login_user']);
    $rajout->bindParam(2, $_POST['email']);
    $rajout->bindParam(3, $_POST['password']);
  
    //executer la requete préparé
    //PDOstatement::execute - éxécuté une requete préparée
    //Elle execute la requete passè dans un tableau de valeur
    
   
    $rajout->execute(array(
        $_POST['login_user'],
        $_POST['email'],
        $_POST['password']
    
    ));
    
    if($rajout){
        echo "<p class='container alert alert-success'>Votre utilisateur a été ajouté avec succès !</p>";
        echo "<a href='gestion_utilisateur.php' class='container btn btn-success'>Voir l'utilisateur</a>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors de l'ajout de l'utilisateur</p>";
    }
    
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}

    ?>

    
<footer><?php require_once "footer.php";?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>