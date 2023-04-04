<?php session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
  // Rediriger l'utilisateur vers la page de connexion
  header('Location: login.php');
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
    <form action="verif.php" id="form-el" class="form col" method="POST" enctype="multipart/form-data">
      <div class="addgenre">

        <?php
        include_once('fonctionDAL.inc.php');
        $bdd = connexionBase();

        // Verification de l'existence d'un doublon
        $nom_en = $_POST['nomEn'];
        $requete = "SELECT nom_en FROM anime WHERE nomEn = :nom_en";
        $resultats = $bdd->prepare($requete);
        $resultats->bindParam(':nom_en', $nom_en);
        $resultats->execute();

        if ($resultats->rowCount() > 0) {
          // Afficher une alerte pour informer l'utilisateur que l'anime existe déjà
          echo "<script type='text/javascript'>alert('L'anime avec le nom_en " . $nom_en . " existe déjà');</script>";
        }


        //Vérificcation de l'insertion d'un nouvelle anime
        $nombre = DAL_InsertAnime($_POST['nomEn'], $_POST['nomJp'], $_POST['anneeSortie'], $_POST['notes'], $_POST['statu'], $_POST['fichier']);
        //echo $nombre;
        if ($nombre == 1) {
          $message = 'Progression sauvegarder!';
        } else {
          $message = 'Erreur pendant la sauvegarde';
        }

        ///Affichage du nom et de l'image de l'anime en cours d'ajout
        $requetename = "SELECT nom_en, photo FROM anime ORDER BY id DESC LIMIT 1;";
        $resultasname = $bdd->prepare($requetename);
        $resultasname->execute();
        $name = $resultasname->fetch();
        echo '<tr><td></td><td><img src=' . $name['photo'] . ' class="imggenre"></td></tr>';
        echo "<div><p class='genrede'>Genre de : </p></div>";
        echo "<div><p class='genrede'name='listAnime' id='listAnime'>" . $name['nom_en'] . "</p></div>";


        ///Affichage de la liste des genres
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

        <input type="hidden" name="listAnime" value="<?php echo $name['nom_en']; ?>">
      </div>

      <button class="btn">Ajouter en BDD</button>

      <button type="button" class="redirect-button">Ajouter un autre genre</button>
      <script>
        $(document).ready(function () {
          $('form').submit(function (event) {
            event.preventDefault();
            $listAnime = $_POST['listAnime'];
            $selectedGenre = $_POST['selectedGenre'];
            DAL_InsertGenre($listAnime, $selectedGenre);
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