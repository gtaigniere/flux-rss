<?php


namespace Controller;


use Exception;
use Manager\FluxManager;
use Model\Article;
use Model\Flux;
use PDO;

/**
 * Class FluxController
 * @package Controller
 */
class FluxController extends RssController
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * @var fluxManager
     */
    private $fluxManager;

    /**
     * FluxController constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        parent::__construct();
        $this->fluxManager = new FluxManager($db);
    }

    /**
     * Affiche tous les flux
     * @throws Exception
     */
    public function all()
    {
        $fluxs = $this->fluxManager->all();
        foreach($fluxs as $flux) {
            $flux->setLastBuildDate($flux->getLastBuildDate());
        }
        $this->render(ROOT_DIR . 'view/fluxs.php', compact('fluxs'));
    }

    /**
     * Affiche le flux dont l'id est passé en paramètre
     * @param int $id
     * @throws Exception
     */
    public function one($id)
    {
        $flux = $this->fluxManager->one($id);
        if ($flux != null) {
            $flux->setLastBuildDate($flux->getLastBuildDate());
            $this->render(ROOT_DIR . 'view/flux.php', compact('flux'));
        } else {
            // ToDo : Voir quoi faire par la suite
        }
    }

    /**
     * @param $url
     * @throws Exception
     */
    public function createFluxFromUrl($url)
    {
        $rss = simplexml_load_file($url)->channel;
        $flux = Flux::flowFromUrl($rss);
    }

}
