<?php
session_start();
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<div class=" container mt-5 border">
    <div class=" text-center bg-success rounded-pill text-dark p-2 border border-warning border-5">
        <H1>Connexion</H1>
        <div class="text-center">


            <img src="assets/img/logo.jpg" alt="Logo du shop" title="logo du shop" class="rounded-circle" width="100">
        </div>
    </div>


    <div class="container bg-warning w-50 border border-success border-5 mt-2">
        <div class="mt-2 alerte alerte-success p-3">
            <div class="container">
                <form method="POST">

                    <label for="email" class="form-label">Votre email</label>
                    <input type="text" class="form-control text-center w-50 rounded-pill" name="email" id="email" required><br>



                    <label for="password" class="form-label">Votre mot de passe</label>
                    <input type="password" class="form-control text-center w-50 rounded-pill" name="password" id="password" required><br>

                    <button class="bouton-connexion bg-success rounded-pill p-2" name="btn-connexion">Connexion à votre compte</button><br>
                </form>

            </div>
            <?php

            function connexion(){
                echo "bonjour";

                $user = "root";
                $pass = "";
                $baseDonne = "ecommerce";
                $hote = "localhost";
                try{
                    $baseUser = new PDO("mysql:host=".$hote.";dbname=".$baseDonne.";charset=UTF8", $user, $pass);

                    $baseUser->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "<p class='container alert-alert-success'>Vous etes connecté à PDO</p>";
                }catch(PDOException $e){
                    print "erreur ! :" .$e->getMessage() . "</br>";

                    die();
                }

                if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) &&!empty($_POST['password'])){
                    //faille xss = ON DESINFECTE LES DONNÉES = Sanitize
                    //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
                    //htmlspecialchars — Convertit les caractères spéciaux en entités HTML :: Cette fonction retourne une chaîne de caractères avec ces modificationss
                    $emailUser = trim(htmlspecialchars($_POST['email']));
                    $passwordUser = trim(htmlspecialchars($_POST['password']));
                    var_dump($emailUser);
                    var_dump($passwordUser);
                    //Requete avec le prediquats AND = &&
                    $sql ="SELECT * FROM user WHERE email = ? AND password = ? ";

                    //requète préparée pour lutter contre les inection SQL
                    $connexionUser = $baseUser->prepare($sql);

                    //Lie les paramètre du formulaire a  la requète SQL
                    $connexionUser->bindParam(1, $emailUser);
                    $connexionUser->bindParam(2, $passwordUser);

                    //Execute la requète et retourne un tableau associatif
                    $connexionUser->execute();

                    //Si on a au moins 1 utilisateur dans table (index du tableau commence par 0)
                    if($connexionUser->rowCount() >=0 ){
                        var_dump($connexionUser->rowCount());
                        //On stock dans une variable le dernier resultat
                        //PDOStatement::fetch — Récupère la ligne suivante d'un jeu de résultats PDO
                        $ligneUser = $connexionUser->fetch();
                        var_dump($ligneUser);
                        //Si on on a un resultat = retour true
                        if($ligneUser == true){
                            //On recup les email et password de la table utilisateurs
                            $email = $ligneUser['email'];
                            var_dump($email);
                            $password = $ligneUser['password'];
                            //Condition de connexion
                            //Si entrée utilisateur = valeurs dans la table pour email et mot de passe
                            if($emailUser === $email && $passwordUser === $password){

                                $_SESSION['email'] = $emailUser;
                                header("location: pages/menu.php");
                                //Erreur de mail et mot de passe
                            }else{
                                echo "<div class='mt-3 container'>
                            <p class='alert alert-danger p-3'>Erreur de connexion: merci de verifié votre email et mot de passe</p>
                            </div>";
                            }
                        }else{
                            //pas d'utilisateur dans la table
                            echo "<div class='mt-3 container'>
                <p class='alert alert-danger p-3'>Erreur de connexion: Aucun utilisateur dans votre table</p>
                </div>";
                        }
                    }else{
                        //pas d'utilisateur dans la table
                        echo "Votre table est vide";
                    }
                }else{

                    echo "Merci de remplir tout les champs";
                }



            }

            //Le clic sur le bouton on appel la fonction de  connexion
            if(isset($_POST['btn-connexion'])){
                connexion();
            }
            ?>



        </div>

    </div>
</div>



<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>