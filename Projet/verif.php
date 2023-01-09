<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css"/>
        <title>verification</title>
    </head>
<body>
    <main class="main">
    <form id="form-el" class="form col">
      <div class="containers">
<?php
    include_once('fonctionDAL.inc.php');

        ///Changement du nom du fichier et envoie dans un dossier précis
        $user = $_POST['nomEn'];
        $tmp_name = "";
        $file_name = "";
        $folder = "";
        if (isset($_FILES['fichier'])) {
            // echo 'bonjour';
            $tmp_name = $_FILES['fichier']['tmp_name'];
            $tmp_file = $_FILES['fichier']['name']; 
            $extension = pathinfo($tmp_file, PATHINFO_EXTENSION);
            $file_name ="".$user. "." .$extension;
            $folder = 'C:/laragon/www/DejaVu/Projet/image/';
             //echo $tmp_name;
             //echo $file_name;
        }

        // if (move_uploaded_file($tmp_name, $folder . $file_name)) 
        //  {
        //      echo " Envoie réussi !";
        //  } else {
        //      echo "Echec de l'envoie";
        //  }

            ///         Vérificcation de l'insertion d'un nouvelle anime

            $nombre = DAL_InsertRealisation($_POST['nomEn'], $_POST['nomJp'], $_POST['anneeSortie'], $_POST['notes'], $_POST['statu'], $file_name);
             //echo $nombre;
            if($nombre == 1)
            {
                $message = 'Votre participation à bien été prise en compte!';
            }
            else
            {
                $message = 'Votre participation à echoué';
            }
    

            ?>
            <div class="btn2">
            <!-- afiche le message de reussite ou d'echec -->
            <p><?php echo $message ?></p>
            <a href="Ajouter.php">Retour</a>
            <?php //$eco = array(DAL_VerifParticipation(2));
            //print json_encode($eco); ?>
            </div>
              </div>
        </form>
        </main>
    </body>
    </main>
</html>