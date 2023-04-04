<?php session_start(); ?>
<html class="bg">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="main.css" media="screen" type="text/css" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="main.css" />
</head>
<main class="main">
  <title>Acceuil</title>

  <body>
    <div id="home">
      <div class="container">
        <form action="http://localhost/DejaVu/Projet/Ajouter.php" class="menu">
          <p class="titreMenu">Razmo's List</p>

          <?php
          // Vérifie si la variable de session est définie / l'utilisateur est connecter
          if (isset($_SESSION['connected'])) {
            // Afficher le bouton Ajout
            echo '<input type="buttonMenu" value="Admin" class="BtnMenu2" style="cursor: pointer" onclick="window.location.href=\'http://localhost/DejaVu/Admin.php\'" />';
          }
          //Vérifie si la variable de session n'est pas définie / l'utilisateur n'est pas connecter
          if (!isset($_SESSION['connected'])) {
            // Afficher le bouton Connexion
            echo '<input type="buttonMenu" value="Connexion" class="BtnMenu3" style="cursor: pointer" onclick="window.location.href=\'http://localhost/DejaVu/iden.php\'" />';
          }
          // Afficher le bouton deconnexion
          if (isset($_SESSION['connected'])) {
            echo '<input type="buttonMenu" value="Déconnexion" class="BtnMenu3" style="cursor: pointer" onclick="window.location.href=\'http://localhost/DejaVu/deco.php\'" />';
          }
          ?>

        </form>
        <div class="filtre1" style="position: absolute; right: 20px; top: 80px;">
          <input type="button" value="A - Z" class="filtre" style="cursor: pointer; display: inline-block"
            onclick="window.location.href='http://localhost/DejaVu/'" />
          <input type="button" value="Z - A" class="filtre" style="cursor: pointer; display: inline-block"
            onclick="window.location.href='http://localhost/DejaVu/OrderbyNameZtoA.php'" />
          <input type="button" value="High - Low" class="filtre" style="cursor: pointer; display: inline-block"
            onclick="window.location.href='http://localhost/DejaVu/OrderbyNoteHigh.php'" />
          <input type="button" value="Low - High" class="filtre" style="cursor: pointer; display: inline-block"
            onclick="window.location.href='http://localhost/DejaVu/OrderbyNoteLow.php'" />
          <input type="button" value="New - Old" class="filtre" style="cursor: pointer; display: inline-block"
            onclick="window.location.href='http://localhost/DejaVu/OrderbyDateNew.php'" />
          <input type="button" value="Old - New" class="filtre" style="cursor: pointer; display: inline-block"
            onclick="window.location.href='http://localhost/DejaVu/OrderbyDateOld.php'" />
        </div>
        <div class="slider">
          <div class="slider-page">
            <div class=show>
              <?php
              include_once('fonctionDAL.inc.php');
              $bdd = connexionBase();


              ///Gros bordel qui sert a afficher les anime présent dans la BDD avec vérification
              ///qui permet de ne pas afficher les valeurs NULL
              $requete = "SELECT * FROM anime ORDER BY note limit 0,24;"; ///Changer le noombres de tableau afficher ici
              $resultats = $bdd->prepare($requete);
              $resultats->execute();

              while ($donnees = $resultats->fetch()) {
                if (!empty($donnees['nom_en']) || ($donnees['nom_jp'])) {
                  echo "<table>";
                  echo '<tr><td class="tdImg"></td><td class="tdImg"><img src=' . $donnees['photo'] . ' class="img" onclick="showImage1(this)"></td></tr>';
                  echo "<tr><td>Nom Anglais</td><td>" . $donnees['nom_en'] . "</td></tr>";
                  echo "<tr><td>Nom Japonais</td><td>" . $donnees['nom_jp'] . "</td></tr>";
                  $nameAnime = $donnees['nom_en'];
                  echo "<tr><td>Status</td><td>" . $donnees['statu'] . "</td></tr>";
                  echo "<tr><td>Note</td><td>" . $donnees['note'] . " / 20</td></tr>";
                  echo "<tr><td>Année de sortie</td><td>" . $donnees['annee_sortie'] . "</td></tr>";
                  $requete2 = "SELECT DISTINCT libelle_genre from anime_genre WHERE nom_en_anime = '$nameAnime' ORDER BY libelle_genre";
                  $resultats2 = $bdd->prepare($requete2);
                  $resultats2->execute();
                  echo "<tr><td>Liste des genres</td>";
                  echo "<td><select class='listeG'>";

                  $donnees2 = $resultats2->fetch();

                  if (!$donnees2) {
                    echo "<option>En attente de genre</option>";
                  } else {
                    echo "<option>" . $donnees2['libelle_genre'] . "</option>";
                    while ($donnees2 = $resultats2->fetch()) {
                      echo "<option>" . $donnees2['libelle_genre'] . "</option>";
                    }
                  }

                  echo "</select></td></tr>";
                  echo "</table>";
                }
              }
              $resultats->closeCursor();
              ?>

              <div id="myModal1" class="modal1">
                <span class="close1">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption1"></div>
                <span id="close1">&times;</span>
              </div>

              <!--Script qui permet de voir l'image en grand taille avec croix pour fermer la fenètre
              soit en appuyant sur la touche echap ou en appuyant dans une zone vide--->
              <script>
                function showImage1(img) {
                  var modal = document.getElementById("myModal1");
                  var modalImg = document.getElementById("img01");
                  modal.style.display = "block";
                  modalImg.src = img.src;

                  var close = document.getElementsByClassName("close1")[0];
                  close.onclick = function () {
                    modal.style.display = "";
                  }
                  document.onkeydown = function (evt) {
                    evt = evt || window.event;
                    if (evt.keyCode == 27) {
                      closeModal1();
                    }
                  };
                  document.getElementById("myModal1").addEventListener("click", function () {
                    if (event.target == modal) {
                      closeModal1();
                    }
                  });

                  function closeModal1() {
                    var modal = document.getElementById("myModal1");
                    modal.style.display = "none";
                  }
                }
              </script>
            </div>
          </div>
          <div class="slider-page">
            <div class=show>
              <?php
              include_once('fonctionDAL.inc.php');
              $bdd = connexionBase();


              ///Gros bordel qui sert a afficher les anime présent dans la BDD avec vérification
              ///qui permet de ne pas afficher les valeurs NULL
              $requete = "SELECT * FROM anime ORDER BY note limit 24,24;"; ///Changer  le nombre de tableau afficher ici
              $resultats = $bdd->prepare($requete);
              $resultats->execute();

              $total = $resultats->rowCount();
              $i = 1;
              while ($donnees = $resultats->fetch()) {
                if (!empty($donnees['nom_en']) || ($donnees['nom_jp'])) {
                  echo "<table>";
                  echo '<tr><td class="tdImg"></td><td class="tdImg"><img src=' . $donnees['photo'] . ' class="img" onclick="showImage2(this)"></td></tr>';
                  echo "<tr><td>Nom Anglais</td><td>" . $donnees['nom_en'] . "</td></tr>";
                  echo "<tr><td>Nom Japonais</td><td>" . $donnees['nom_jp'] . "</td></tr>";
                  $nameAnime = $donnees['nom_en'];
                  echo "<tr><td>Status</td><td>" . $donnees['statu'] . "</td></tr>";
                  echo "<tr><td>Note</td><td>" . $donnees['note'] . " / 20</td></tr>";
                  echo "<tr><td>Année de sortie</td><td>" . $donnees['annee_sortie'] . "</td></tr>";
                  $requete2 = "SELECT DISTINCT libelle_genre from anime_genre WHERE nom_en_anime = '$nameAnime' ORDER BY libelle_genre";
                  $resultats2 = $bdd->prepare($requete2);
                  $resultats2->execute();
                  echo "<tr><td>Liste des genres</td>";
                  echo "<td><select class='listeG'>";

                  $donnees2 = $resultats2->fetch();

                  if (!$donnees2) {
                    echo "<option>En attente de genre</option>";
                  } else {
                    echo "<option>" . $donnees2['libelle_genre'] . "</option>";
                    while ($donnees2 = $resultats2->fetch()) {
                      echo "<option>" . $donnees2['libelle_genre'] . "</option>";
                    }
                  }

                  echo "</select></td></tr>";
                  echo "</table>";
                }
              }

              $resultats->closeCursor();
              ?>

              <div id="myModal2" class="modal2">
                <span class="close2">&times;</span>
                <img class="modal-content" id="img02">
                <div id="caption2"></div>
                <span id="close2">&times;</span>
              </div>

              <!--Script qui permet de voir l'image en grand taille avec croix pour fermer la fenètre
              soit en appuyant sur la touche echap ou en appuyant dans une zone vide--->
              <script>
                function showImage2(img) {
                  var modal = document.getElementById("myModal2");
                  var modalImg = document.getElementById("img02");
                  modal.style.display = "block";
                  modalImg.src = img.src;

                  var close = document.getElementsByClassName("close2")[0];
                  close.onclick = function () {
                    modal.style.display = "";
                  }
                  document.onkeydown = function (evt) {
                    evt = evt || window.event;
                    if (evt.keyCode == 27) {
                      closeModal2();
                    }
                  };
                  document.getElementById("myModal2").addEventListener("click", function () {
                    if (event.target == modal) {
                      closeModal2();
                    }
                  });

                  function closeModal2() {
                    var modal = document.getElementById("myModal2");
                    modal.style.display = "none";
                  }
                }
              </script>
            </div>
          </div>
          <div class="slider-page">
            <div class=show>
              <?php
              include_once('fonctionDAL.inc.php');
              $bdd = connexionBase();


              ///Gros bordel qui sert a afficher les anime présent dans la BDD avec vérification
              ///qui permet de ne pas afficher les valeurs NULL
              $requete = "SELECT * FROM anime ORDER BY note limit 48,24;"; ///Changer  le nombre de tableau afficher ici
              $resultats = $bdd->prepare($requete);
              $resultats->execute();

              $total = $resultats->rowCount();
              $i = 1;
              while ($donnees = $resultats->fetch()) {
                if (!empty($donnees['nom_en']) || ($donnees['nom_jp'])) {
                  echo "<table>";
                  echo '<tr><td class="tdImg"></td><td class="tdImg"><img src=' . $donnees['photo'] . ' class="img" onclick="showImage3(this)"></td></tr>';
                  echo "<tr><td>Nom Anglais</td><td>" . $donnees['nom_en'] . "</td></tr>";
                  echo "<tr><td>Nom Japonais</td><td>" . $donnees['nom_jp'] . "</td></tr>";
                  $nameAnime = $donnees['nom_en'];
                  echo "<tr><td>Status</td><td>" . $donnees['statu'] . "</td></tr>";
                  echo "<tr><td>Note</td><td>" . $donnees['note'] . " / 20</td></tr>";
                  echo "<tr><td>Année de sortie</td><td>" . $donnees['annee_sortie'] . "</td></tr>";
                  $requete2 = "SELECT DISTINCT libelle_genre from anime_genre WHERE nom_en_anime = '$nameAnime' ORDER BY libelle_genre";
                  $resultats2 = $bdd->prepare($requete2);
                  $resultats2->execute();
                  echo "<tr><td>Liste des genres</td>";
                  echo "<td><select class='listeG'>";

                  $donnees2 = $resultats2->fetch();

                  if (!$donnees2) {
                    echo "<option>En attente de genre</option>";
                  } else {
                    echo "<option>" . $donnees2['libelle_genre'] . "</option>";
                    while ($donnees2 = $resultats2->fetch()) {
                      echo "<option>" . $donnees2['libelle_genre'] . "</option>";
                    }
                  }

                  echo "</select></td></tr>";
                  echo "</table>";
                }
              }

              $resultats->closeCursor();
              ?>

              <div id="myModal3" class="modal3">
                <span class="close3">&times;</span>
                <img class="modal-content" id="img03">
                <div id="caption3"></div>
                <span id="close3">&times;</span>
              </div>

              <!--Script qui permet de voir l'image en grand taille avec croix pour fermer la fenètre
              soit en appuyant sur la touche echap ou en appuyant dans une zone vide--->
              <script>
                function showImage3(img) {
                  var modal = document.getElementById("myModal3");
                  var modalImg = document.getElementById("img03");
                  modal.style.display = "block";
                  modalImg.src = img.src;

                  var close = document.getElementsByClassName("close3")[0];
                  close.onclick = function () {
                    modal.style.display = "";
                  }
                  document.onkeydown = function (evt) {
                    evt = evt || window.event;
                    if (evt.keyCode == 27) {
                      closeModal3();
                    }
                  };
                  document.getElementById("myModal3").addEventListener("click", function () {
                    if (event.target == modal) {
                      closeModal3();
                    }
                  });

                  function closeModal3() {
                    var modal = document.getElementById("myModal3");
                    modal.style.display = "none";
                  }
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <button class="prev">Précédent</button>
    <button class="next">Suivant</button>
  </footer>
  <script>
    var slider = document.querySelector(".slider");
    var pages = document.querySelectorAll(".slider-page");
    var prevButton = document.querySelector(".prev");
    var nextButton = document.querySelector(".next");

    var currentPage = 0;

    prevButton.addEventListener("click", function () {
      pages[currentPage].style.display = "none";
      currentPage--;
      if (currentPage < 0) {
        currentPage = pages.length - 1;
      }
      pages[currentPage].style.display = "block";
    });

    nextButton.addEventListener("click", function () {
      pages[currentPage].style.display = "none";
      currentPage++;
      if (currentPage >= pages.length) {
        currentPage = 0;
      }
      pages[currentPage].style.display = "block";
    });
  </script>
</main>

</html>