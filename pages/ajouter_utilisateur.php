<?php
session_start();

if(isset($_SESSION['email'])){
function deconnexion() {
    session_unset();
    session_destroy();
    header("location: ../index.php");
    deconnexion();
}
?>

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
}

$sql = "SELECT * FROM user";
$utilisateur =$baseProduit->query($sql);

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

        <div class="container">
            <table class="table table-striped">
                <thead>
                
                    <th scope="col">#ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Editer</th>
                    <th scope="col">Supprimer</th>
                </thead>
           
            <tbody>
            <?php
            
            foreach($utilisateur as $gestionUtilisateur){
            ?>
            <tr>
            <th scope="row"><?=$gestionUtilisateur['login_user']?></th>           
                <th><?=$gestionUtilisateur['email']?></th>
                <th><?=$gestionUtilisateur['password']?></th>
                <th>
                    <a href="ajouter_utilisateur.php?login_user=<?=$gestionUtilisateur['login_user']?>" class="btn btn-success">Éditer</a>
                </th>
                <th>
                    <a href="supprimer_utilisateur.php?login_user=<?=$gestionUtilisateur['login_user']?>" class="btn btn-danger">Supprimer</a>
                </th>
            </tr>
                
            
                <?php    
            }
                ?>
          
            </tbody>
            </table>
        </div>

        <div class="container">
          <form action="traitement_ajouter_un_produit.php" id="form-login" method="POST" enctype="multipart/form-data">
          
            
            <div class="mb-2">
                <label for="email" class="form-label">Renseigner l'email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                
            </div>
            
            <div class="mb-2">
                <label for="password" class="form-label">Renseigner le mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
        
            
            
            <div class="d-flex justify-content-center-around">
                <button type="submit" name="btn-creation" class="btn btn-warning">Ajouter l'utilisateur</button>
                <a href="Ajouter_utilisateur.php" class="btn btn-success">Annuler</a>
            </div>
            
          </form>
          
          </div>  









<?php
}else{
    echo"<a href='' class='btn btn-warning'>Se connecter</a>";
    header('Location: ../index.php');
}
?>
<footer><?php require_once "footer.php";?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>