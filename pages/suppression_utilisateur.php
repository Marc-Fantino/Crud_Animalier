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

$sql ="DELETE FROM user WHERE login_user = ?";

//Stock et Recup de id dans l'url avec la super globale GET

$ID =$_GET['login_user'];

$deleteUser = $baseProduit->prepare($sql);

$deleteUser->bindParam(1, $ID);

$deleteUser->execute();

if($deleteUser == true){
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
    <div class="container">
<?php
 echo "<p class='alert alert-success'>L'utilisateur a bien été supprimer</p>";
 echo "<a href='gestion_utilisateur.php' class='btn btn_warning'>Retour</a>";
 ?>
    </div>
 <?php
}else{
    echo"<div class='container'><p class='alert alert-danger'>Erreur lors de la suppression de l'utilisateur</p></div>";
    
}

} else{
    echo"<a href='' class='btn btn-warning'>Se connecter</a>";
    header('Location: ../index.php');
}

?>
<footer><?php require_once "footer.php";?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>