<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>Verification</title>
</head>

<body>
    <main class="main">
        <form id="form-el" class="form col">
            <div class="containers">
                <?php
                include_once('fonctionDAL.inc.php');

                $bdd = connexionBase();

                if (!isset($_SESSION['connected'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Préparation de la requête avec des paramètres nommés
                    $requete = "SELECT COUNT(*) FROM Anime_Compte WHERE nom_compte = :username AND password_compte = SHA2(:password, 256)";
                    $prep = $bdd->prepare($requete);
                    $prep->bindParam(':username', $username, PDO::PARAM_STR);
                    $prep->bindParam(':password', $password, PDO::PARAM_STR);

                    // Exécution de la requête avec les paramètres fournis
                    $prep->execute();
                    $lignes = $prep->fetchColumn();

                    // Vérification des identifiants
                    if ($lignes == 1) {
                        $_SESSION['connected'] = true;
                        echo "coin coin";
                    } else {
                        echo "Identifiants incorrects.";
                    }
                }

                ?>
                <div class="btn3">
                    <?php
                    // Vérifie si la variable de session est définie / l'utilisateur est connecter
                    if (isset($_SESSION['connected'])) {
                        // Afficher le bouton d'acceuil
                        echo '<a href="index.php" class="btn">Retour a l&apos;acceuil</a>';
                    }
                    //Vérifie si la variable de session n'est pas définie / l'utilisateur n'est pas connecter
                    if (!isset($_SESSION['connected'])) {
                        // Afficher le bouton pour rententer la connexion
                        echo '<a href="iden.php" class="btn">S&apos;identifier a nouveau</a>';
                    }
                    // Afficher le bouton d'ajout d'anime
                    if (isset($_SESSION['connected'])) {
                        echo '<a href="Ajouter.php" class="btn">Ajouter un anime</a>';
                    }
                    // Afficher le bouton d'ajout d'un genre
                    if (isset($_SESSION['connected'])) {
                        echo '<a href="ajoutergenre.php" class="btn">Ajouter un genre</a>';
                    }
                    // Afficher le bouton pour modifier un anime
                    if (isset($_SESSION['connected'])) {
                        echo '<a href="ajoutergenre.php" class="btn">Modifier un anime</a>';
                    }
                    // Afficher le bouton pour supprimer un anime
                    if (isset($_SESSION['connected'])) {
                        echo '<a href="ajoutergenre.php" class="btn">Supprimer un anime</a>';
                    }
                    ?>
                </div>
            </div>
        </form>
    </main>
</body>
</main>

</html>