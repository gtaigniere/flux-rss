<?php


namespace App\Manager;


use App\{App, Model\Article, Model\Feed, Util\ErrorManager};
use Exception;
use PDO;

/**
 * Class FeedManager
 * @package Manager
 */
class FeedManager extends DbManager
{
    /**
     * FeedManager constructor.
     */
    public function __construct()
    {
        parent::__construct(App::getInstance()->getDb());
    }

    /**
     * Renvoie tous les flux
     * @return Feed[]
     */
    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM feed');
        return $stmt->fetchAll(PDO::FETCH_CLASS, Feed::class);
    }

    /**
     * Renvoie le flux dont l'id est passé en paramètre (avec les articles)
     * @param int $id
     * @return Feed|null
     * @throws Exception Si l'accès au flux a échoué
     */
    public function one(int $id): ?Feed
    {
        $feed = $this->feedWithoutArticles($id);
        $feed->setArticles($this->articlesFromFeed($id));
        return $feed;
    }

    /**
     * Renvoie le flux dont l'id est passé en paramètre (sans les articles)
     * @param int $id
     * @return Feed|null
     * @throws Exception Si l'accès au flux a échoué
     */
    public function feedWithoutArticles(int $id): ?Feed
    {
        $stmt = $this->db->prepare('SELECT * FROM feed WHERE id = :id');
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception('Une erreur est survenue lors de l\'accès au flux d\'id : ' . $id);
        }
        $result = $stmt->fetchObject(Feed::class);
        if (!$result) {
            throw new Exception('Aucun flux n\'a été trouvé avec l\'id : ' . $id);
        }
        return $result;
    }

    /**
     * Renvoie tous les articles du flux dont l'id est passé en paramètre (sans le flux)
     * @param int $id
     * @return Article[]
     * @throws Exception Si l'accès aux articles a échoué
     */
    public function articlesFromFeed(int $id): array
    {
        $stmt = $this->db->prepare('SELECT * FROM article WHERE feedId = :id');
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception('Une erreur est survenue lors de l\'accès aux articles du flux d\'id : ' . $id);
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    /**
     * Ajoute le flux passé en paramètre (sans les articles)
     * Renvoie celui-ci s'il a bien été ajouté
     * @param Feed $feed
     * @return Feed
     * @throws Exception Si l'ajout a échoué
     */
    public function insert(Feed $feed): Feed
    {
        $stmt = $this->db->prepare( '
            INSERT INTO feed VALUES (
                :id, :website, :description, :url, :lastBuildDate, :pictureUrl)');
        $result = $stmt->execute([
            ':id' => $feed->getId(),
            ':website' => $feed->getTitle(),
            ':description' => $feed->getDescription(),
            ':url' => $feed->getSiteUrl(),
            ':lastBuildDate' => $feed->getLastBuildDate()->format('Y-m-d H:i:s'),
            ':pictureUrl' => $feed->getPictureUrl()
        ]);
        if ($result) {
            return $this->one((int)$this->db->lastInsertId());
        }
        throw new Exception('Une erreur est survenue lors de l\'ajout du flux');
    }

    /**
     * Modify le flux passé en paramètre (sans les articles)
     * Renvoie celui-ci s'il a bien été modifié
     * @param Feed $feed
     * @return Feed
     * @throws Exception Si la mise à jour a échoué ou si le flux n'existe pas en base de données
     */
    public function update(Feed $feed): Feed
    {
        if ($this->one($feed->getId())) {
            $stmt = $this->db->prepare('
                UPDATE feed SET id = :id, website = :website, description = :description,
                    url = :url, lastBuildDate = :lastBuildDate, pictureUrl = :pictureUrl WHERE id = :id');
            $result = $stmt->execute([
                ':id' => $feed->getId(),
                ':website' => $feed->getTitle(),
                ':description' => $feed->getDescription(),
                ':url' => $feed->getSiteUrl(),
                ':lastBuildDate' => $feed->getLastBuildDate()->format('Y-m-d H:i:s'),
                ':pictureUrl' => $feed->getPictureUrl()
            ]);
            if ($result) {
                return $this->one($feed->getId());
            }
            throw new Exception('Une erreur est survenue lors de la mise à jour du flux d\'id : ' . $feed->getId());
        }
        throw new Exception('Aucun flux n\'a été trouvé avec l\'id : ' . $feed->getId());
    }

    /**
     * Supprime le flux dont l'id est passé en paramètre (sans les articles)
     * @param int $id
     * @throws Exception Si la suppression a échoué ou si le flux n'existe pas en base de données
     */
    public function delete(int $id)
    {
        if ($this->one($id)) {
            $stmt = $this->db->prepare('DELETE FROM feed WHERE id = :id');
            if (!$stmt->execute([':id' => $id])) {
                throw new Exception('Une erreur est survenue lors de la suppression du flux d\'id : ' . $id);
            }
        } else {
            throw new Exception('Aucun flux n\'a été trouvé avec l\'id : ' . $id);
        }
    }

}
