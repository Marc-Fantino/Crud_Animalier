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
$user = "root";
$pass = "";
$hote = "localhost";
$baseDonnee = "ecommerce";
try{
$baseProduit = new PDO("mysql:host=".$hote.";dbname=".$baseDonnee.";charset=UTF8", $user, $pass);

$baseProduit->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo"<p class='container alert alert-success text-center'>Vous êtes connectez a PDO Mysql</p>";


}catch(PDOException $e){
print "Erreur ! :" .$e->getMessage() . "</br>";

die();
}

if($baseProduit){

$sql ="SELECT * FROM produit WHERE id_produit = ?";

$id_produit = $_GET['id_produit'];


$request = $baseProduit->prepare($sql);

$request->bindParam(1, $id_produit);



$request->execute();

$detail = $request->fetch(PDO::FETCH_ASSOC);

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
    <div class="container-fluid bg-warning">
                    <h1 class="text-center">Bienvenue : <?=$_SESSION['email']?></h1>
                
                
                    <h3 class="text-center ">Suppresion des produits</h3
                    <div class="container" id="form-delete">
                    
                    
                    <form method="POST" id="form-delete">
                    <p class="text-center text-warning">Supprimer le produit</p>
                    <p class="text-center text-warning">
                    <img src="<?= $detail['image_produit'] ?>" class="img-thumbnail" alt="<?= $detail['nom_produit']?>" title="<?= $detail['nom_produit']?>" width="400"/>
                    </p>
                    <p class="text-center text-warning"><?= $detail['nom_produit']?></p>
                    <p class="text-center text-warning"><?= $detail['description_produit']?></p>
                    
                    
                  
                    <div class="d-flex justify-content-center">
                    <button type="submit" name="btn-delete" class="btn btn-danger">Confirmer la suppression ?</button>
                    <a href="menu.php" class="btn btn-success">Annuler la demande de suppression</a>
                    </div>
                    
                    </form>
                 
                                  
                    <?php
                    if($detail['stock_produit'] == true){
                    echo "Oui";
                                                    
                    }else{
                    echo "Non";
                     }
                  
                    if(isset($_POST['btn-delete'])){
                        $sql ="DELETE FROM produit WHERE id_produit = ?";
                        $delete = $baseProduit->prepare($sql);
                        $id_produitDelete = $_GET['id_produit'];
                        
                        $delete->bindParam(1, $id_produitDelete);
                        $delete->execute();
                        
                        if($delete){
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
                        echo "<div class='container'><a href='produits.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
                    }
                    
                    }
                    ?>
                    
                    
                    </div>
                      
                  
                   
                
                            
                 
                            
    </div>
        
    
    <?php
           } else{
        echo"<a href='' class='btn btn-warning'>Se connecter</a>";
        header('Location: ../index.php');
    }
    ?>
    <footer><?php require_once "footer.php";?></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>