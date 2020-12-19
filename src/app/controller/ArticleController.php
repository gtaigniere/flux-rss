<?php


namespace App\Controller;


use App\{
    Manager\ArticleManager
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
     * @throws Exception
     */
    public function all()
    {
        $articles = $this->articleManager->all();
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
        $this->render(ROOT_DIR . 'view/article.php', compact('article'));
    }

    /**
     * Affiche tous les articles du flux dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception
     */
    public function allByFlux(int $id)
    {
        $articles = $this->articleManager->allByFlux($id);
        $this->render(ROOT_DIR . 'view/articles.php', compact('articles'));
    }

}
