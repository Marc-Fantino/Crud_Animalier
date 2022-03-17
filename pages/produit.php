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
<?php
$user = "root";
$pass = "";
$hote ="localhost";
$basededonne = "ecommerce";
try{
$baseProduit = new PDO("mysql:host=".$hote. ";dbname=".$basededonne. ";charset=UTF8", $user, $pass);

$baseProduit ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
echo"erreur !" .$e->getMessage() . "</br>";

die();
}if($baseProduit){
//requete SQL pour recupérer les produits
    $sql = "SELECT * FROM produit WHERE id_produit = ?";
    
    $id_produit = $_GET['id_produit'];
   
    
    //requete préparée = PDO::prepare - Prépare une requete à l'éxécution et retourne un objet
    //https://www.php.net/manual/fr/pdo.prepare.php pour comprendre l'action PDO::prepare
    $request = $baseProduit->prepare($sql);
    
    
    //lié les paramètres = 1 = ? dans sql : la valeur est l'ID recupérer dans l'URL grace a $_GET['id_produit']
    $request->bindParam(1, $id_produit);
   
    
    //on éxécute la requete (dans le tableau)
    $request->execute();
   
    
    //retourne dans le tableau assiocatif les resultats et le informations du produit avec les clef dans le tableau
    $details = $request->fetch(PDO::FETCH_ASSOC);
    
    
}

?>
<div class="container" id="dragon">
                <div class="col">
                    <div class="card w-50 bg-dark rounded-top text-center">
                        
                            <h4 class="card-title text-info"><?= $details['nom_produit']?></h4>
                            <img src="<?= $details['image_produit']?>" class="card-img-top img-fluid" alt="<?=$details['nom_produit']?>">
                    </div>   
                </div> 
                <div class="col">
                    <div class="card-body">
                                <p class="text-dark"><?= $details['description_produit']?></p>
                                <p class="text-success fw-bold">Prix :<?=$details['prix_produit']?>€</p>
                                <p>Disponible :
                                <?php
                                    if($details['stock_produit'] == true){
                                        echo "Oui";
                                        
                                    }else{
                                    echo "Non";
                                    }
                                  ?>  
                                </p>
                                
                            <div class="container d-flex justify-content-center text-center">
                                    <a href="menu.php" class="mt-2 btn btn-success">Retour au menu</a>
                                    
                            </div>
                        
                    </div>
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