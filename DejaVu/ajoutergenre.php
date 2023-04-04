<?php session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    // Rediriger l'utilisateur vers la page de connexion
    header('Location: iden.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
    <title>Ajouter</title>
</head>

<body>
    <main class="main">
        <form action="verif.php" id="form-el" class="form col1" method="POST" enctype="multipart/form-data">
            <div class="addgenre">
                <?php
                include_once('fonctionDAL.inc.php');

                ///Affichage de la liste des animes
                $bdd = connexionBase();
                $requete = "SELECT * FROM anime ORDER BY nom_en ASC;";
                $resultats = $bdd->prepare($requete);
                $resultats->execute();

                echo "<div><p class='genrede'>Genre de : </p></div>";
                echo "<select name='listAnime' id='listAnime'>";
                echo "<option>-------Liste des animes-------</option>";
                while ($donnees = $resultats->fetch()) {
                    echo "<option>" . $donnees['nom_en'] . "</option>";
                }
                echo "</select>";


                ///Affichage de la liste de genre
                $requete = "SELECT * FROM genre ORDER BY libelle ASC;";
                $resultats = $bdd->prepare($requete);
                $resultats->execute();

                echo "<select name='selectedGenre' id='selectedGenre'>";
                echo "<option>-------Choisir un genre-------</option>";
                while ($donnees = $resultats->fetch()) {
                    echo "<option>" . $donnees['libelle'] . "</option>";
                }
                echo "</select>";

                $resultats->closeCursor();
                ?>

                <script>
                    $(document).ready(function () {
                        $('form').submit(function (event) {
                            event.preventDefault();

                            $nameEn = $_POST['listeAnime'];
                            $selectedGenre = $_POST['selectedGenre'];
                            echo($nameEn);
                            echo($selectedGenre);
                            DAL_InsertGenre($nameEn, $selectedGenre);
                        });
                    });
                </script>

            </div>

            <button class="btn">Ajouter en BDD</button>

            <!-- <button type="button" class="redirect-button">Ajouter un autre genre</button> -->
            <script>
                $(document).ready(function () {
                    $('form').submit(function (event) {
                        event.preventDefault();
                        include_once('fonctionDAL.inc.php');

                        $bdd = connexionBase();
                        $requetename = "SELECT nom_en FROM anime ORDER BY id DESC LIMIT 1;";
                        $resultasname = $bdd -> prepare($requetename);
                        $resultasname -> execute();
                        $name = $resultasname -> fetch();
                        $nameEn = $name['nom_en'];
                        $selectedGenre = $_POST['selectedGenre'];
                        DAL_InsertGenre($nameEn, $selectedGenre);
                    });

                    $('.redirect-button').click(function () {
                        window.location.href = window.location.href;
                    });
                });
            </script>
        </form>
    </main>
</body>
<script src="./main.js"></script>

</html>