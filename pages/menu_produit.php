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
//Connexion a la base de donnée ecommerce via PDO
// Les varable de phpmyadmin
$user = "root";
$pass = "";
//test d'erreur
try{
/*
    PHP Data Objects est une extention définissant l'interface pour accéder à une base de données avec php. Elle est orientée objet la classe s'appelant PDO
*/
$baseProduit = new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", $user, $pass);
/*

le symbole"double deux-points(::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une class
*/
$baseProduit->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo"vous etes connectez a la base de données";
}catch(PDOException $e){
echo"erreur !:" .$e->getMessage() . "</br>";


die();
}if($baseProduit){
    $sql = "SELECT * FROM produit";
    $sql1 ="SELECT * FROM materiel";
    
    $statement = $baseProduit->query($sql);
    $statement1 = $baseProduit->query($sql1);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu produit</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<header><?php require_once "header.php";?>

<form method="POST">
            <button class="mt-3 btn-warning" name="btn-deconnexion">Déconnection</button>
        </form>
</header>
<div class="container-fluid bg-warning">
    <h1 class="text-center">Bienvenue : <?=$_SESSION['email']?></h1>


    <h3 class="text-center ">Mes produits</h3>

    <div class="row">
            <?php
            foreach($statement as $produit){
                $date_depot = new DateTime($produit['date_depot']);
                ?>
                <div class="col-md-4 col-sm-12 p-1 rounded-top">
                    <div class="card bg-dark" style="height: 100%;">
                        
                            <h4 class="card-title text-info"><?= $produit['nom_produit']?></h4>
                            <img src="<?= $produit['image_produit']?>" class="card-img-top img-fluid" alt="<?=$produit['nom_produit']?>"style="height: 100%;">
                        
                        <div class="card-body text-center">
                                <p class="card-text"><?= $date_depot->format("d/m/Y")?></p>
                                <p>Disponible :
                                <?php
                                    if($produit['stock_produit'] == true){
                                        echo "Oui";
                                        
                                    }else{
                                    echo "Non";
                                    }
                                  ?>  
                                </p>
                                
                                <div class="container d-flex justify-content-center text-center">
                                    <a href="produit.php?id_produit=<?= $produit['id_produit']?>" class="mt-2 btn btn-success">Detail produit</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="mt-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#Produit<?=$produit['id_produit']?>">
                                      En savoir plus
                                    </button>
                                   
                                    <a href="suppression_produit.php?id_produit=<?= $produit['id_produit']?>" class="mt-2 btn btn-danger">Suppression produit</a>
                                    <a href="ajout_produit.php?id_produit=<?= $produit['id_produit']?>" class="mt-2 btn btn-warning">Création produit</a>
                                    <a href="ajout_editer_produit.php?id_produit=<?= $produit['id_produit']?>" class="mt-2 btn btn-success">édition produit</a>
                                    
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="Produit<?=$produit['id_produit']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content"> 
                                          <div class="modal-header text-center">
                                            <h5 class="modal-title" id="exampleModalLabel"><?= $produit['nom_produit']?></h5>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body" id="dragon" >
                                          <div class="card w-25 bg-dark rounded-top text-center">
                                            <img src="<?= $produit['image_produit']?>" class="card-img-top img-fluid" alt="<?=$produit['nom_produit']?>">
                                            
                                            </div>  
                                            <p><?= $produit['description_produit']?></p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                
                                </div>
                        </div>
                     </div>
                </div>
            <?php
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