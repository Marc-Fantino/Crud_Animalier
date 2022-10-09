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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="menu.php">
            <img src="../assets/img/logo.jpg" class="rounded-circle" alt="blueline-dev" title="Marc-blueline.com" width="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="menu_produit.php">Produit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="menu_materiel.php">Materiel</a>
                </li>
              
            </ul>

        </div>
    </div>
</nav>
<?php
} else{
    echo"<a href='' class='btn btn-warning'>Se connecter</a>";
    header('Location: ../index.php');
}

?>
<div><img class="img-fluid" src="../assets/img/bambou.jpg" alt="photo_bambou"></div>
<footer><?php require_once "footer.php";?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>