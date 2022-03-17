<?php
session_start();

if(isset($_SESSION['prenom'])){
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
$baseDonne = "ecommerce";
$hote ="localhost";
try{
    $editerBase = new PDO("mysql:host=".$hote.";dbname=".$baseDonne.";charset=UTF8", $user, $pass);
    
    $editerBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p class='container alert-alert-success'>Vous etes connecté à PDO</p>";
    
}catch(PDOException $e){

print"erreur ! " .$e->getMessage() . "</br>";

die();
}
    if($editerBase){
    //Requete SQL de selection des produits
    $sql = "SELECT * FROM produit WHERE id_produit = ?";
    
    $id_editer = $_GET['id_produit'];
    //grace a PDO on accède à la base methode query()
    // requete preparée
    $request = $editerBase->prepare($sql);
    //Lié les paramètres 
    $request->bindParam(1, $id_editer);
    
    //Execution de la requète
    $request->execute();
    //Retourne un objet de resultats
    
    $editer = $request->fetch(PDO::FETCH_ASSOC);
    
    ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer de produit</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><?php require_once "header.php";?></header>

<div class="container-fluid bg-warning">
        <h1 class="text-center"> Bienvenue: <?=$_SESSION['prenom']?></h1>
        
        <h3 class="text-center">Éditer des produits</h3>
               
          <div class="container">
          <form action="traitement_editer_un_produit.php?id_produit=<?=$editer['id_produit']?>" id="form-login" method="POST" enctype="multipart/form-data">
          
            <div class="text-center">
                <img src="../assets/img/logo.jpg" class="rounded-circle" alt="Logo du shop" title="logo du shop" width="200">
            </div>
            
            <div class="mb-2">
                <label for="nom_produit" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="nom_produit" name="nom_produit" required value="<?=$editer['nom_produit']?>">
            </div>
            
            <div class="mb-2">
                <label for="description_produit" class="form-label">Description du produit</label>
                <textarea class="form-control" name="description_produit" id="description_produit" cols="15" rows="5"value="<?=$editer['description_produit']?>"></textarea>
            </div>
            
            <div class="mb-2">
                <label for="prix_produit" class="form-label">Prix du produit</label>
                <input type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit" required value="<?=$editer['prix_produit']?>">
            </div>
            
            <div class="mb-2">
                <label for="stock_produit" class="form-label">Disponibilité du produit</label>
                    <select name="stock_produit" id="stock_produit" class="form-control">
                        <option value="0">Non</option>
                        <option value="1">Oui</option>
                    </select>
                </div>
            
            <div class="mb-2">
                <label for="date_depot" class="form-label">Date de dépot du produit</label>
                <input type="date" class="form-control" id="date_depot" name="date_depot" value="<?=$editer['date_depot']?>" required>
            </div>
            
            <div class="mb-2">
                <label for="image_produit" class="form-label">Image du produit</label>
                <input type="file" class="form-control" id="image_produit" name="image_produit" value="<?=$editer['image_produit']?>" required>
            </div>
            
            <div class="d-flex justify-content-center-around">
                <button type="submit" name="btn-creation" class="btn btn-warning">Mettre a jour le produit</button>
                <a href="menu.php" class="btn btn-success">Annuler</a>
            </div>
            
          </form>
          
          </div>  

</div>

<?php
    }

?>


    

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