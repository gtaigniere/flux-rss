<?php


namespace Controller;


use Exception;
use Manager\ArticleManager;
use PDO;

/**
 * Class ArticleController
 * @package Controller
 */
class ArticleController extends RssController
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * @var ArticleManager
     */
    private $articleManager;

    /**
     * RssController constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        parent::__construct();
        $this->articleManager = new ArticleManager($db);
    }

    /**
     * Affiche tous les articles
     * @throws Exception
     */
    public function all()
    {
        $articles = $this->articleManager->all();
        foreach($articles as $article) {
            $article->setReleaseDate($article->getReleaseDate());
        }
        $this->render(ROOT_DIR . 'view/articles.php', compact('articles'));
    }

    /**
     * Affiche l'article dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception
     */
    public function one($id)
    {
        $article = $this->articleManager->one($id);
        if ($article != null) {
            $this->render(ROOT_DIR . 'view/article.php', compact('article'));
        } else {
            // ToDo : Voir quoi faire par la suite
        }
    }

    /**
     * Affiche tous les articles du flux dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception
     */
    public function articlesByFlux(int $id)
    {
        $articles = $this->articleManager->articlesByFlux($id);
        $this->render(ROOT_DIR . 'view/articles.php', compact('articles'));
    }

}
