<?php


namespace App\Controller;


use App\{
    Manager\ArticleManager,
    Model\Article,
    Util\ErrorManager
};
use Exception;

/**
 * Class ArticleController
 * @package Controller
 */
class ArticleController extends RssController
{
    /**
     * @var ArticleManager
     */
    private $articleManager;

    /**
     * RssController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->articleManager = new ArticleManager();
    }

    /**
     * Affiche tous les articles
     */
    public function all()
    {
        $articles = $this->articleManager->all();
        $this->render(ROOT_DIR . 'view/articles.php', compact('articles'));
    }

    /**
     * Affiche tous les articles orphelins
     */
    public function orphans()
    {
        $articles = $this->articleManager->orphans();
        $orphan = true;
        $this->render(ROOT_DIR . 'view/articles.php', compact('articles', 'orphan'));
    }

    /**
     * Affiche l'article dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception
     */
    public function one($id)
    {
        $article = $this->articleManager->one($id);
        $this->render(ROOT_DIR . 'view/article.php', compact('article'));
    }

    /**
     * Crée un article avec les paramètres reçus
     * @param array $params Tableau associatif dont les clefs et valeurs
     * correspondent respectivement aux champs "name" et "value" du formulaire
     */
    public function add(array $params): void
    {
        try {
            $article = new Article();
            $article->setId(array_key_exists('id', $params) ? (int)$params['id'] : null);
            $article->setTitle($params['title']);
            $article->setDescription($params['description']);
            $article->setLink($params['link']);
            $article->setCategory($params['category']);
            $article->setReleaseDate($params['releaseDate']);
            $article->setPictureLink($params['pictureLink']);
            $article->setFeedId($params['feedId']);
            $this->articleManager->insert($article);
            $this->all();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

    /**
     * Modifie un article avec les paramètres reçus
     * @param array $params Tableau associatif dont les clefs et valeurs
     * correspondent respectivement aux champs "name" et "value" du formulaire
     */
    public function modify(array $params): void
    {
        try {
            $article = new Article();
            $article->setId(array_key_exists('id', $params) ? (int)$params['id'] : null);
            $article->setTitle($params['title']);
            $article->setDescription($params['description']);
            $article->setLink($params['link']);
            $article->setCategory($params['category']);
            $article->setReleaseDate($params['releaseDate']);
            $article->setPictureLink($params['pictureLink']);
            $article->setFeedId($params['feedId']);
            $this->articleManager->update($article);
            $this->all();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

    /**
     * Supprime l'article dont l'id est passé en paramètre
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (array_key_exists('validate', $_POST) && $_POST['validate']) {
            try {
                $this->articleManager->delete($id);
                $this->all();
            } catch (Exception $e) {
                ErrorManager::add($e->getMessage());
            }
        } else {
            $this->validate($_POST);
        }
    }

    /**
     * @param array $params
     * Supprime tous les articles orphelins
     */
    public function deleteOrphans($params): void
    {
        if (array_key_exists('validate', $params) && $params['validate']) {
            try {
                $this->articleManager->deleteOrphans();
                $this->all();
            } catch (Exception $e) {
                ErrorManager::add($e->getMessage());
            }
        } else {
            $this->validate($params);
        }
    }

}
