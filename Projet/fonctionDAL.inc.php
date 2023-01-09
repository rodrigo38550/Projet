<?php
	// connexion à la base de données anime
	function connexionBase() {
		$hote='mysql:host=localhost;port=3306;dbname=anime';
		$utilisateur='Anime_admin'; 
		$mot_passe='%tt9sAq39}/JZ,4V'; 
		try {
			$connexion = new PDO($hote, $utilisateur, $mot_passe);
			$connexion->exec("set names utf8");
			return $connexion;
		}
		catch(PDOException $e) {
			throw new Exception('Connexion impossible');
		}
	}

    function DAL_getAllRealisation() {
		try {
			$connexion=connexionBase();
			$requete = 'SELECT nom_en, nom_jp, annee_sortie, note, statu, photo from anime';
			$lignes = $connexion->query($requete)->fetchAll(PDO::FETCH_ASSOC);
			return $lignes;
		}
		catch (Exception $e) {
			throw new Exception("DAL_getAllRealisation() " .$e->getMessage());
		}
	}

    function DAL_InsertRealisation($nomEn, $nomJp, $anneeSortie, $notes, $statu, $fichier) {
        try {
			$connexion=connexionBase();
			$requete = 'INSERT INTO anime  (nom_en, nom_jp, annee_sortie, note, statu, photo) VALUES(:nom_en, :nom_jp, :annee_sortie, :note, :statu, :photo)'; 
			$prep = $connexion->prepare($requete);
			$prep->bindValue(':nom_en', $nomEn, PDO::PARAM_STR);
            $prep->bindValue(':nom_jp', $nomJp, PDO::PARAM_STR);
            $prep->bindValue(':annee_sortie', $anneeSortie, PDO::PARAM_STR);
            $prep->bindValue(':note', $notes, PDO::PARAM_STR);
            $prep->bindValue(':statu', $statu, PDO::PARAM_STR);
            $prep->bindValue(':photo', $fichier, PDO::PARAM_STR);
			$ok =$prep->execute();
			return $prep->rowCount();
		}
		catch (Exception $e) {
			//throw new Exception("DAL_updateConcurrent() " .$e->getMessage());
			return $e->getMessage();
        }
    }
?>