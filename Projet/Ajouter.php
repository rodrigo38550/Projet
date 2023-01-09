<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Connection</title>
  </head>
  <body>
    <main class="main">
      <div class="container">
        <form action="verif.php" id="form-el" class="form col" method="POST" enctype="multipart/form-data">
          <input
            class="form-input"
            type="text"
            name="nomEn"
            id="EnName"                      
            placeholder="Nom Anglais"
            minlength="5"
            required
          />
          <input
            class="form-input"
            type="text"
            name="nomJp"
            id="JpName"
            placeholder="Nom Japonais"
            minlength="5"
            required
          />
          <input
            class="form-input"
            type="text"
            name="notes"
            id="Note"
            placeholder="Note sur 20"
            required
          />
          <p class="p">Année de sortie</p>
          <input
            class="form-input"
            type="Date"
            name="anneeSortie"
            id="Annee_sortie"
            placeholder="Année de sortie"
            required
          />
          <select name="statu" id="Statu" class="select">
          <option value="Fini">Fini</option>
          <option value="En cours">En cours</option>
          <option value="A venir">A venir</option>
          </select>
          <p class="p">Selectioner la couverture de l'anime (200x282)</p> <!--Aucune vérification pour l'instant-->
          <input
            type="file"
            id="file"
            class="file"
            name="fichier"
            accept="image/png, image/jpeg, image/jpg"
            required
          />

          <button class="btn">Submit</button>
        </form>
      </div>
    </main>
  </body>
  <script src="./main.js"></script>
</html>
