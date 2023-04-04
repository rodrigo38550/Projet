<?php
// connexion à la base de données anime
function connexionBase()
{
  $hote = 'mysql:host=localhost;port=3306;dbname=anime';
  $utilisateur = 'Anime_admin';
  $mot_passe = '%tt9sAq39}/JZ,4V';
  try {
    $connexion = new PDO($hote, $utilisateur, $mot_passe);
    $connexion->exec("set names utf8");
    return $connexion;
  } catch (PDOException $e) {
    throw new Exception('Connexion impossible');
  }
}

function DAL_getAllAnime()
{
  try {
    $connexion = connexionBase();
    $requete = 'SELECT nom_en, nom_jp, annee_sortie, note, statu, photo from anime';
    $lignes = $connexion->query($requete)->fetchAll(PDO::FETCH_ASSOC);
    return $lignes;
  } catch (Exception $e) {
    throw new Exception("DAL_getAllAnime() " . $e->getMessage());
  }
}

function DAL_getAllGenre()
{
  try {
    $connexion = connexionBase();
    $requete = 'SELECT libelle from genre';
    $lignes = $connexion->query($requete)->fetchAll(PDO::FETCH_ASSOC);
    return $lignes;
  } catch (Exception $e) {
    throw new Exception("DAL_getAllGenre() " . $e->getMessage());
  }
}

function DAL_InsertAnime($nomEn, $nomJp, $anneeSortie, $notes, $statu, $fichier)
{
  try {
    $connexion = connexionBase();
    $requete = 'INSERT INTO anime  (nom_en, nom_jp, annee_sortie, note, statu, photo) VALUES(:nom_en, :nom_jp, :annee_sortie, :note, :statu, :photo)';
    $prep = $connexion->prepare($requete);
    $prep->bindValue(':nom_en', $nomEn, PDO::PARAM_STR);
    $prep->bindValue(':nom_jp', $nomJp, PDO::PARAM_STR);
    $prep->bindValue(':annee_sortie', $anneeSortie, PDO::PARAM_STR);
    $prep->bindValue(':note', $notes, PDO::PARAM_STR);
    $prep->bindValue(':statu', $statu, PDO::PARAM_STR);
    $prep->bindValue(':photo', $fichier, PDO::PARAM_STR);
    $ok = $prep->execute();
    return $prep->rowCount();
  } catch (Exception $e) {
    //throw new Exception("DAL_updateConcurrent() " .$e->getMessage());
    return $e->getMessage();
  }
}

function DAL_InsertGenre($name, $genre)
{
  try {
    $connexion = connexionBase();
    $requete = 'INSERT INTO anime_genre  (nom_en_anime, libelle_genre) VALUES(:nom_en_anime, :libelle_genre)';
    $prep = $connexion->prepare($requete);
    $prep->bindValue(':nom_en_anime', $name, PDO::PARAM_STR);
    $prep->bindValue(':libelle_genre', $genre, PDO::PARAM_STR);
    $ok = $prep->execute();
    return $prep->rowCount();
  } catch (Exception $e) {
    //throw new Exception("DAL_updateConcurrent() " .$e->getMessage());
    return $e->getMessage();
  }
}

function DAL_getGenreFromAnime($nomAnime)
{
  try {
    $namee = $nomAnime;
    $connexion = connexionBase();
    $requete = 'SELECT libelle_genre from anime_genre WHERE nom_en_anime = "$namee"';
    $lignes = $connexion->query($requete)->fetchAll(PDO::FETCH_ASSOC);
    return $lignes;
  } catch (Exception $e) {
    throw new Exception("DAL_getAllGenre() " . $e->getMessage());
  }
}
?>