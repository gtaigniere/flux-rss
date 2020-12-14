<?php


namespace App\Manager;


use App\Model\Article;
use Exception;
use PDO;

/**
 * Class ArticleManager
 * @package Manager
 */
class ArticleManager
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * ArticleManager constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // ToDo : Pouvoir trier par critères (date, ordre alphabétique, catégorie)

    /**
     * Renvoie tous les articles
     * @return Article[]
     */
    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM article');
        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    /**
     * Renvoie l'article dont l'id est passé en paramètre
     * @param int $id
     * @return Article|null
     * @throws Exception Si l'accès à l'article a échoué
     */
    public function one(int $id): ?Article
    {
        $stmt = $this->db->prepare('SELECT * FROM article WHERE id = :id');
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception('Une erreur est survenue lors de l\'accès à l\'article d\'id : ' . $id);
        }
        $result = $stmt->fetchObject(Article::class);
        if (!$result) {
            throw new Exception('Aucun article n\'a été trouvé avec l\'id : ' . $id);
        }
        return $result;
    }

    /**
     * Ajoute l'article passé en paramètre
     * Renvoie celui-ci s'il a bien été ajouté
     * @param Article $article
     * @return Article
     * @throws Exception Si l'ajout a échoué
     */
    public function insert(Article $article): Article
    {
        $stmt = $this->db->prepare( '
            INSERT INTO article VALUES (:id, :title, :description, :link,
                :category, :releaseDate, :pictureLink, :fluxId)');
        $result = $stmt->execute([
            ':id' => $article->getId(),
            ':title' => $article->getTitle(),
            ':description' => $article->getDescription(),
            ':link' => $article->getLink(),
            ':category' => $article->getCategory(),
            ':releaseDate' => $article->getReleaseDate(),
            ':pictureLink' => $article->getPictureLink(),
            ':fluxId' => $article->getFluxId()
        ]);
        if ($result) {
            return $this->one((int)$this->db->lastInsertId());
        }
        throw new Exception('Une erreur est survenue lors de l\'ajout de l\'article');
    }

    /**
     * Modify l'article passé en paramètre
     * Renvoie celui-ci s'il a bien été modifié
     * @param Article $article
     * @return Article
     * @throws Exception Si la mise à jour a échoué ou si l'article n'existe pas en base de données
     */
    public function update(Article $article): Article
    {
        if ($this->one($article->getId())) {
            $stmt = $this->db->prepare('
                UPDATE article SET id = :id, title = :title, description = :description, link = :link,
                    category = :category, releaseDate = :releaseDate, pictureLink = :pictureLink, fluxId = :fluxId WHERE id = :id');
            $result = $stmt->execute([
                ':id' => $article->getId(),
                ':title' => $article->getTitle(),
                ':description' => $article->getDescription(),
                ':link' => $article->getLink(),
                ':category' => $article->getCategory(),
                ':releaseDate' => $article->getReleaseDate(),
                ':pictureLink' => $article->getPictureLink(),
                ':fluxId' => $article->getFluxId()
            ]);
            if ($result) {
                return $this->one($article->getId());
            }
            throw new Exception('Une erreur est survenue lors de la mise à jour de l\'article d\'id : ' . $article->getId());
        }
        throw new Exception('Aucun article n\'a été trouvé avec l\'id : ' . $article->getId());
    }

    /**
     * Supprime l'article dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception Si la suppression a échoué ou si l'article n'existe pas en base de données
     */
    public function delete(int $id)
    {
        if ($this->one($id)) {
            $stmt = $this->db->prepare('DELETE FROM article WHERE id = :id');
            if (!$stmt->execute([':id' => $id])) {
                throw new Exception('Une erreur est survenue lors de la suppression de l\'article d\'id : ' . $id);
            }
        } else {
            throw new Exception('Aucun article n\'a été trouvé avec l\'id : ' . $id);
        }
    }

    /**
     * Renvoie tous les articles du flux dont l'id est passé en paramètre (sans le flux)
     * @param int $id
     * @return Article[]
     * @throws Exception Si l'accès aux articles a échoué
     */
    public function allByFlux(int $id): array
    {
        $stmt = $this->db->prepare('SELECT * FROM article WHERE fluxId = :id');
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception('Une erreur est survenue lors de l\'accès à l\'article d\'id : ' . $id);
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

}