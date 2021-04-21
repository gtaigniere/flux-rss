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
     */
    public function feedWithArticles($url)
    {
        $feed = null;
        $articles = [];
        try {
            $headers = @get_headers($url);
            if($headers && strpos( $headers[0], '200')) {
                if (count(preg_grep ('/^Content-Type: (\w+)\/xml(\w*)/i', $headers)) > 0) {
                    $feed = Feed::fromUrl($url);
                    $articles = $feed->getArticles();
                } else {
                    ErrorManager::add("L'Url ne correspond pas à un flux RSS");
                }
            } else {
                ErrorManager::add("L'Url n'existe pas");
            }
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        } finally {
            $this->render(ROOT_DIR . 'view/feed.php', compact('feed', 'articles'));
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
     */
    public function all()
    {
        $feeds = $this->feedManager->all();
        $this->render(ROOT_DIR . 'view/feeds.php', compact('feeds'));
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
     * Crée et ajoute un flux avec l'url reçue
     * @param string $url Adresse web du flux
     */
    public function add(string $url): void
    {
        try {
            $feed = Feed::fromUrl($url);
            $lastInsertFeed = $this->feedManager->insert($feed);
            $articles = (array) $feed->getArticles();
            foreach ($articles as $article) {
                $article->setFeedId($lastInsertFeed->getId());
                $this->articleManager->insert($article);
            }
            $this->all();
        } catch (Exception $e) {
            ErrorManager::add($e->getMessage());
        }
    }

    /**
     * Modifie un flux (sans ses articles) avec les paramètres reçus
     * @param array $params Tableau associatif dont les clefs et valeurs
     * correspondent respectivement aux champs "name" et "value" du formulaire
     */
    public function modify(array $params): void
    {
        if (array_key_exists('validate', $_POST) && $_POST['validate']) {
            try {
                $feed = new Feed();
                $feed->setId($params['id']);
                $feed->setFeedUrl($params['feedUrl']);
                $feed->setTitle($params['title']);
                $feed->setDescription($params['description']);
                $feed->setSiteUrl($params['siteUrl']);
                $feed->setLastBuildDate($params['lastBuildDate']);
                $this->feedManager->update($feed);
                $this->all();
            } catch (Exception $e) {
                ErrorManager::add($e->getMessage());
            }
        } else {
            $this->validate($params);
        }
    }

    /**
     * Supprime le flux dont l'id est passé en paramètre
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (array_key_exists('article', $_POST)) {
            try {
                if ($_POST['article'] == true) {
                    $this->articleManager->deleteAllByFeedId($id);
                }
                $this->feedManager->delete($id);
                $this->all();
            } catch (Exception $e) {
                ErrorManager::add($e->getMessage());
            }
        } else {
            $this->render(ROOT_DIR . 'view/delChoice.php', compact('id'));
        }
    }

}
