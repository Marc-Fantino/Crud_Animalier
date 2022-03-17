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
    
    if(isset($_FILES['image_produit'])){
    $repertoireImage = "../assets/img/";
    //la photo est téléchargé
    //basename - Retourne le nom de la composante
    //dans le tableau multi dimmension 1 = image 2 = son nom
    $photoImage = $repertoireImage . basename($_FILES['image_produit']['name']);
    // on recupe l'image uploader
    //on assigne l'image au repertoir de destination de la photo et le nom qui se rajoute dans le tableau
    $_POST['image_produit'] = $photoImage;
    
    //Les conditions de réussite
    //move_uploaded_file- Deplace un fichier téléchargé
    //on assigne à la photo un nom temporaire random en cas d'echec d'upload
    if(move_uploaded_file($_FILES['image_produit'] ['tmp_name'], $photoImage)){
        echo "<p class='container alert-alert-success'>Le fichier est validé et téléchargé avec success</p>";
    
    }else{
        echo "<p class='container alert-alert-danger'>Erreur lors du téléchargement</p>";
    }

}else{
    echo "<p class='container alert-alert-success'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}
    
$user = "root";
$pass = "";
$baseDonne = "ecommerce";
$hote = "localhost";
try{
    $editerBase = new PDO("mysql:host=".$hote.";dbname=".$baseDonne.";charset=UTF8", $user, $pass);

    $editerBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert-alert-success'>Vous etes connecté à PDO</p>";
}catch(PDOException $e){
print "erreur ! :" .$e->getMessage() . "</br>";

die();
}

if($editerBase){
var_dump($editerBase);
    $sql = "UPDATE `produit` SET `nom_produit`= ?, `description_produit`= ?, `prix_produit`= ?, `stock_produit`= ?, `date_depot`= ?, `image_produit`= ? WHERE id_produit = ?";
    //Requete préparée = connexion + methode prepare + requete sql
    // Les requetes préparée lutte contre les injections SQL
    //PDO : prepare - Prepare une requete à l'exécution et retourne un objet
    $editer = $editerBase->prepare($sql);

    //executer la requete préparé
    //PDOstatement::execute - éxécuté une requete préparée
    //Elle execute la requete passè dans un tableau de valeur
   
    $editer->execute(array(
       
        $_POST['nom_produit'],
        $_POST['description_produit'],
        $_POST['prix_produit'],
        $_POST['stock_produit'],
        $_POST['date_depot'],
        $_POST['image_produit'],
        $_GET['id_produit']
    ));
   
    
    if($editer){
    var_dump($editer);
        echo "<p class='container alert alert-success'>Votre produit a été mise à jour avec succès !</p>";
        echo "<a href='menu.php' class='container btn btn-success'>Voir mon produit</a>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors de l'édition du produit</p>";
        echo "<a href='menu.php' class='container btn btn-danger'>Voir mon produit</a>";
    }
    
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}

    ?>
 
    
<footer><?php require_once "footer.php";?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<?php
           } else{
        echo"<a href='' class='btn btn-warning'>Se connecter</a>";
        header('Location: ../index.php');
    }
    ?>
</html>