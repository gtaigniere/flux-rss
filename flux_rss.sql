--
-- Base de données :  `flux_rss`
--
CREATE DATABASE IF NOT EXISTS flux_rss DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE flux_rss;

-- --------------------------------------------------------
--
-- Structure de la table `flux`
--
CREATE TABLE IF NOT EXISTS flux (
    id INT NOT NULL AUTO_INCREMENT,
    website VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    lastBuildDate DATETIME NOT NULL,
    PRIMARY KEY (id)
);

--
-- Contenu de la table `flux`
--
INSERT INTO flux (id, website, description, url, lastBuildDate)
    VALUES ();

-- --------------------------------------------------------
--
-- Structure de la table `article`
--
CREATE TABLE IF NOT EXISTS article (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    releaseDate DATETIME NOT NULL,
    pictureLink VARCHAR(255) DEFAULT NULL,
    fluxId INT DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_articleFlux FOREIGN KEY (fluxId) REFERENCES flux (id)
);

--
-- Contenu de la table `article`
--
INSERT INTO article (id, title, description, link, category, releaseDate, pictureLink, fluxId)
    VALUES ();

