<?php


namespace App\Controller;


use App\{
    Manager\ArticleManager,
    Manager\FeedManager,
    Model\Feed,
    Util\ErrorManager
};
use Exception;

/**
 * Class FeedController
 * @package Controller
 */
class FeedController extends RssController
{
    /**
     * @var FeedManager
     */
    private $feedManager;

    /**
     * @var ArticleManager
     */
    private $articleManager;

    /**
     * FeedController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->feedManager = new FeedManager();
        $this->articleManager = new ArticleManager();
    }

    // ToDo : Actualiser les différents flux

    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        $this->render(ROOT_DIR . 'view/index.php', compact([]));
    }

    /**
     * Recherche sur le web le flux dont l'url est passé en paramètre
     * puis l'affiche (avec les articles)
     * @param $url
     * @throws Exception
     */
    public function feedWithArticles($url)
    {
        $feed = null;
        try {
            $feed = Feed::fromUrl($url);
            $articles = $feed->getArticles();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        } finally {
            $this->render(ROOT_DIR . 'view/index.php', compact('feed', 'articles'));
        }
    }

    /**
     * Recherche le flux dont l'url est passé en paramètre
     * puis l'affiche (sans les articles)
     * @param $url
     */
    public function feedWithoutArticles($url)
    {
        $feed = null;
        $articles = [];
        try {
            $feed = Feed::fromUrl($url);
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        } finally {
            $this->render(ROOT_DIR . 'view/index.php', compact('feed', 'articles'));
        }
    }

        /**
     * Affiche tous les flux
     * @throws Exception
     */
    public function all()
    {
        $feeds = $this->feedManager->all();
        $this->render(ROOT_DIR . 'view/index.php', compact('feeds'));
    }

    /**
     * Affiche le flux dont l'id est passé en paramètre (avec les articles)
     * @param int $id
     * @throws Exception
     */
    public function one($id)
    {
        try {
            $feed = $this->feedManager->one($id);
            $articles = $feed->getArticles();
            $this->render(ROOT_DIR . 'view/feed.php', compact('feed', 'articles'));
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

    /**
     * Crée et ajoute un flux (sans ses articles) avec l'url reçue
     * @param string $url Adresse web du flux
     */
    public function add(string $url): void
    {
        try {
            $feed = Feed::fromUrl($url);
            $this->feedManager->insert($feed);
            $this->all();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

    /**
     * Modifie un flux (sans ses articles) avec les paramètres reçus (sans ses articles)
     * @param array $params Tableau associatif dont les clefs et valeurs
     * correspondent respectivement aux champs "name" et "value" du formulaire
     */
    public function modify(array $params): void
    {
        try {
            $feed = new Feed();
            $feed->setId($params['id']);
            $feed->setTitle($params['website']);
            $feed->setDescription($params['description']);
            $feed->setSiteUrl($params['url']);
            $feed->setLastBuildDate($params['lastBuildDate']);
            $feed->setPictureUrl($params['pictureUrl']);
            $this->feedManager->update($feed);
            $this->all();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

    /**
     * Supprime le flux (sans ses articles) dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception
     */
    public function delete(int $id): void
    {
        try {
            $this->feedManager->delete($id);
            $this->all();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

}
