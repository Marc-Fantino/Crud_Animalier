<?php
session_start();

if(isset($_SESSION['email'])){
function deconnexion() {
session_unset();
session_destroy();
header("location:../index.php");
deconnexion();
}

?>
<?php
$user = "root";
$pass = "";
$hote = "localhost";
$BaseDonnee ="ecommerce";

try{
$baseMateriel =new PDO("mysql:host=".$hote.";dbname=".$BaseDonnee.";charset=UTF8", $user, $pass);

$baseMateriel->setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);
echo"<p class='container alert alert-success text-center'>Vous etes connectez à la bonne base</p>";
 
}catch(PDOException $e){
print "erreur ! :" .$e->getMessage() . "</br>";
die();
}

if($baseMateriel){
$sql ="SELECT * FROM materiel WHERE id_produit = ?";

$id_materiel = $_GET['id_produit'];

$request = $baseMateriel->prepare($sql);

$request->bindParam(1, $id_materiel);

$request->execute();

$materiel =$request->fetch(PDO::FETCH_ASSOC);

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression des produits</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><?php require_once "header.php";?></header>

<div class="container-fluid bg-warning">
        <h1 class="text-center"> Bienvenue: <?=$_SESSION['prenom']?></h1>
        
        <div class="text-center">
                   <img src="../assets/img/logo.jpg" alt="Logo du shop" title="logo du shop" class="rounded-circle" width="200">
               </div>
        <div class="container d-flex justify-content-center text-center">
        
              
            <a href="menu.php" class="mt-2 btn btn-success">Retour au menu</a>
                                    
        </div>
        
        <h3 class="text-center">Suppression des produits</h3>
            <div class="container" id="form-delete">
            
                <form method="POST" id="form-delete">
                <p class="text-center text-warning"> supprimer le produit</p>
                <p class="text-center text-warning">
                    <img src="<?= $materiel['image_produit' ]?>" class="img-thumbnail" alt="<?= $materiel['nom_produit' ]?>" title="<?= $materiel['nom_produit' ]?>" width="400"/>   
                </p>
                <p class="text-center text-warning"><?= $materiel['nom_produit' ]?></p>
                <p class="text-center text-warning"><?= $materiel['description_produit' ]?></p>
                
                <div class="d-flex justify-content-center">
                    <button type="submit" name="btn-delete" class="btn btn-danger">Confirmer la suppression ?</button>
                    <a href="menu.php" class="btn btn-success">Annuler la demande de suppression</a>
                </div>
                </form>
            <?php
            if($materiel['stock_produit'] == true ){
            echo "Oui";
            }else{
            echo "Non";
             }
            if(isset($_POST['btn-delete'])){
            $sql ="DELETE FROM materiel WHERE id_produit = ?";
            $materiel = $baseMateriel->prepare($sql);
            $id_deleteMateriel =$_GET['id_produit'];
            
            $materiel->bindParam(1, $id_deleteMateriel);
            $materiel->execute();
            
            if($materiel){
                echo "<p class='container alert alert-success'>Votre produit a bien été supprimer !</p>";
                echo "<div class='container'><a href='menu.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
            ?>
            <style>
            #form-delete{
            display: none;
            }
            </style>
            <?php
            }else{
                echo "<p class='alert alert-danger'>Erreur lors de la supression du produit !</p>";
                echo "<div class='container'><a href='menu.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
            }
            }
            ?>
            
            
            
            </div>

</div>


    

<footer><?= require_once"footer.php"?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<?php
}else{
echo"<a href='' class='btn btn-warning'>Se deconnecter</a>";
header('location:../index.php');
}
?>
</html>