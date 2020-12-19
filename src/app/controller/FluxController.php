<?php


namespace App\Controller;


use App\{
    Manager\ArticleManager,
    Manager\FluxManager
};
use Exception;

/**
 * Class FluxController
 * @package Controller
 */
class FluxController extends RssController
{
    /**
     * @var fluxManager
     */
    private $fluxManager;

    /**
     * @var fluxManager
     */
    private $articleManager;

    /**
     * FluxController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->fluxManager = new FluxManager();
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
     * Affiche tous les flux
     * @throws Exception
     */
    public function all()
    {
        $fluxs = $this->fluxManager->all();
        $this->render(ROOT_DIR . 'view/fluxs.php', compact('fluxs'));
    }

    /**
     * Affiche le flux dont l'id est passé en paramètre (sans les articles)
     * @param int $id
     * @throws Exception
     */
    public function one($id)
    {
        $flux = $this->fluxManager->one($id);
        $this->render(ROOT_DIR . 'view/flux.php', compact('flux'));
    }

    /**
     * Affiche le flux dont l'id est passé en paramètre (avec les articles)
     * @param int $id
     * @throws Exception
     */
    public function oneWithArticles(int $id)
    {
        $flux = $this->fluxManager->one($id);
        $articles = $this->articleManager->allByFlux($id);
        $this->render(ROOT_DIR . 'view/fluxFull.php', compact('flux', 'articles'));
    }

}
