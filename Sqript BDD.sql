CREATE TABLE Genre(
    id INT(2) NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(30),
    CONSTRAINT pk_genre PRIMARY KEY(id)
);

CREATE TABLE Anime_Genre(
    id_anime INT(4),
    id_genre INT(2)
);

CREATE TABLE Anime(
    id INT(4) NOT NULL AUTO_INCREMENT,
    nom_en VARCHAR(120),
    nom_jp VARCHAR(120),
    annee_sortie DATE,
    note FLOAT(4),
    statu VARCHAR(10),
    photo VARCHAR(150),
    CONSTRAINT pk_anime PRIMARY KEY(id)
);

-- VALUES TABLE GENRE
INSERT INTO Genre(libelle)
VALUES('Action');
INSERT INTO Genre(libelle)
VALUES('Amitié');
INSERT INTO Genre(libelle)
VALUES('Aventure');
INSERT INTO Genre(libelle)
VALUES('Combat');
INSERT INTO Genre(libelle)
VALUES('Comédie');
INSERT INTO Genre(libelle)
VALUES('Cyberpunk');
INSERT INTO Genre(libelle)
VALUES('Drame');
INSERT INTO Genre(libelle)
VALUES('Ecchi');
INSERT INTO Genre(libelle)
VALUES('Enigme et Policier');
INSERT INTO Genre(libelle)
VALUES('Fantastique');
INSERT INTO Genre(libelle)
VALUES('Gastronomie');
INSERT INTO Genre(libelle)
VALUES('Harem');
INSERT INTO Genre(libelle)
VALUES('Hentai');
INSERT INTO Genre(libelle)
VALUES('Historique');
INSERT INTO Genre(libelle)
VALUES('Horreur');
INSERT INTO Genre(libelle)
VALUES('Idols');
INSERT INTO Genre(libelle)
VALUES('Isekai');
INSERT INTO Genre(libelle)
VALUES('Mafia');
INSERT INTO Genre(libelle)
VALUES('Magical Girl');
INSERT INTO Genre(libelle)
VALUES('Magique');
INSERT INTO Genre(libelle)
VALUES('Mecha');
INSERT INTO Genre(libelle)
VALUES('Militaire');
INSERT INTO Genre(libelle)
VALUES('Musical');
INSERT INTO Genre(libelle)
VALUES('Mystère');
INSERT INTO Genre(libelle)
VALUES('Pshycologique');
INSERT INTO Genre(libelle)
VALUES('Romance');
INSERT INTO Genre(libelle)
VALUES('School Life');
INSERT INTO Genre(libelle)
VALUES('Sci-Fiction');
INSERT INTO Genre(libelle)
VALUES('Shonen');
INSERT INTO Genre(libelle)
VALUES('Shoujo');
INSERT INTO Genre(libelle)
VALUES('Sport');
INSERT INTO Genre(libelle)
VALUES('Surnaturel');
INSERT INTO Genre(libelle)
VALUES('Survival Game');
INSERT INTO Genre(libelle)
VALUES('Thriller');
INSERT INTO Genre(libelle)
VALUES('Tranche de Vie');
INSERT INTO Genre(libelle)
VALUES('Triangle Amoureux');
INSERT INTO Genre(libelle)
VALUES('Yaoi');
INSERT INTO Genre(libelle)
VALUES('Yuri');