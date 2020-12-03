<?php


namespace Manager;


use Exception;
use Model\Article;
use Model\Flux;
use PDO;

/**
 * Class FluxManager
 * @package Manager
 */
class FluxManager
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * FluxManager constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Renvoie tous les flux
     * @return Flux[]
     */
    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM flux');
        return $stmt->fetchAll(PDO::FETCH_CLASS, Flux::class);
    }

    /**
     * Renvoie le flux dont l'id est passé en paramètre
     * @param int $id
     * @return Flux|null
     * @throws Exception Si l'accès au flux a échoué
     */
    public function one(int $id): ?Flux
    {
        $stmt = $this->db->prepare('SELECT * FROM flux WHERE id = :id');
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception('Une erreur est survenue lors de l\'accès au flux d\'id : ' . $id);
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS, Flux::class);
        $result = $stmt->fetch();
        if (!$result) {
            throw new Exception('Aucun flux n\'a été trouvé avec l\'id : ' . $id);
        }
        return $result;
    }

    /**
     * Ajoute le flux passé en paramètre
     * Renvoie celui-ci s'il a bien été ajouté
     * @param Flux $rss
     * @return Flux
     * @throws Exception Si l'ajout a échoué
     */
    public function insert(Flux $rss): Flux
    {
        $stmt = $this->db->prepare( 'INSERT INTO flux VALUES (:id, :website, :description, :url, :lastBuildDate)');
        $result = $stmt->execute([
            ':id' => $rss->getId(),
            ':website' => $rss->getWebsite(),
            ':description' => $rss->getDescription(),
            ':url' => $rss->getUrl(),
            ':lastBuildDate' => $rss->getLastBuildDate()
        ]);
        if ($result) {
            return $this->one((int)$this->db->lastInsertId());
        }
        throw new Exception('Une erreur est survenue lors de l\'ajout du flux');
    }

    /**
     * Modify le flux passé en paramètre
     * Renvoie celui-ci s'il a bien été modifié
     * @param Flux $rss
     * @return Flux
     * @throws Exception Si la mise à jour a échoué ou si le flux n'existe pas en base de données
     */
    public function update(Flux $rss): Flux
    {
        if ($this->one($rss->getId())) {
            $stmt = $this->db->prepare('UPDATE flux SET id = :id, website = :website, description = :description, url = :url, lastBuildDate = :lastBuildDate WHERE id = :id');
            $result = $stmt->execute([
                ':id' => $rss->getId(),
                ':website' => $rss->getWebsite(),
                ':description' => $rss->getDescription(),
                ':url' => $rss->getUrl(),
                ':lastBuildDate' => $rss->getLastBuildDate()
            ]);
            if ($result) {
                return $this->one($rss->getId());
            }
            throw new Exception('Une erreur est survenue lors de la mise à jour du flux d\'id : ' . $rss->getId());
        }
        throw new Exception('Aucun flux n\'a été trouvé avec l\'id : ' . $rss->getId());
    }

    /**
     * Supprime le flux dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception Si la suppression a échoué ou si le flux n'existe pas en base de données
     */
    public function delete(int $id)
    {
        if ($this->one($id)) {
            $stmt = $this->db->prepare('DELETE FROM flux WHERE id = :id');
            if (!$stmt->execute([':id' => $id])) {
                throw new Exception('Une erreur est survenue lors de la suppression du flux d\'id : ' . $id);
            }
        } else {
            throw new Exception('Aucun flux n\'a été trouvé avec l\'id : ' . $id);
        }
    }

    /**
     * Renvoie tous les articles du flux dont l'id est passé en paramètre
     * @param int $id
     * @return Article[]
     * @throws Exception Si l'accès aux articles a échoué
     */
    public function allByFlux(int $id): array
    {
        $stmt = $this->db->prepare('SELECT * FROM article WHERE rssId = :id');
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception('Une erreur est survenue lors de l\'accès à l\'article d\'id : ' . $id);
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

}
