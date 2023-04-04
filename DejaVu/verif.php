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

        if (!isset($_POST['listAnime'])) {
          $_POST['listAnime'] = '';
        }
        $selectedAnime = $_POST['listAnime'];

        if (!isset($_POST['selectedGenre'])) {
          $_POST['selectedGenre'] = '';
        }
        $selectedGenre = $_POST['selectedGenre'];

        $message = '';
        if (!empty($selectedAnime) && !empty($selectedGenre)) {
          // Vérification si le genre existe déjà pour cet anime
          $requete3 = "SELECT COUNT(*) FROM anime_genre WHERE nom_en_anime = '$selectedAnime' AND libelle_genre = '$selectedGenre'";
          $resultats = $bdd->prepare($requete3);
          $resultats->execute();
          $count = $resultats->fetchColumn();


          if ($count > 0) {
            // Afficher un message d'alerte si le genre existe déjà
            echo "<script>alert('Ce genre est déjà présent pour cet anime veuillez en choisir un autre.'); window.location.href = 'ajoutergenre.php';</script>";

          } else {
            // Sinon, insérer le nouveau genre pour l'anime sélectionné
            //          Vérificcation de l'insertion d'un nouvelle anime
            $nombre = DAL_InsertGenre($selectedAnime, $selectedGenre);
            //echo $nombre;
            if ($nombre == 1) {
              $message = 'Progression sauvegarder!';
            } else {
              $message = 'Erreur pendant la sauvegarde';
            }
          }
          $resultats->closeCursor();
        }

        ?>
        <div class="btn3">
          <!-- afiche le message de reussite ou d'echec -->
          <?php echo ($message); ?>
          <a href="index.php" class="btn">Retour a l'acceuil</a>
          <a href="Ajouter.php" class="btn">Ajouté un nouvelle anime</a>
          <a href="ajoutergenre.php" class="btn">Ajouté un nouveau genre</a>
        </div>
      </div>
    </form>
  </main>
</body>
</main>

</html>