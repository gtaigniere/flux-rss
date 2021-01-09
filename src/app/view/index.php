<?php

use App\Model\Feed;
use App\Util\ErrorManager;

/*
 * https://www.clubic.com/feed/news.rss
 * http://www.metal-impact.com/rss.xml
 * http://feeds.feedburner.com/spirit-of-metal/fr?format=xml
 * https://www.lemonde.fr/societe/rss_full.xml
 * https://www.lemonde.fr/sport/rss_full.xml
 * https://www.francetvinfo.fr/faits-divers.rss
 * https://www.francetvinfo.fr/animaux.rss
 */
//if ($article === null) : echo '<p>aucun article correspondant</p>';
?>

    <section class="sect-home">

        <h1>Flux RSS</h1>

        <?php
        foreach (ErrorManager::getMessages() as $message) : ?>
            <p class="alert alert-danger" role="alert">
                <?= $message ?>
            </p>
        <?php endforeach;
        ErrorManager::destroy();
        ?>

        <form method="POST">
            <label for="feed" >Flux à afficher : </label>
            <input type="text" id="feed" name="url" <?= array_key_exists('url', $_POST) ? 'value="' . $_POST['url'] . '"' : ''; ?> placeholder="Adresse du flux" required>
            <button class="btn btn-success" type="submit" formaction="?target=feed&action=url">Afficher</button>
            <button class="btn btn-primary" type="submit" formaction="?target=feed&action=add">Enregistrer</button>
        </form>

        <?php if (isset($feed, $articles) && $feed instanceof Feed) : ?>
        <h2><?= $feed->getDescription() ?></h2>
        <div class="articles">
            <?php foreach($articles as $article) : ?>
            <p class="article">
                <a href="<?= $article->getLink(); ?>">
                    <img class="img-item" src="<?= $article->getPictureLink(); ?>" alt="">
                </a>
                <a href="<?= $article->getLink(); ?>">
                    <span class="title"><?= $article->getTitle(); ?></span></a><br>
                <?= strip_tags($article->getDescription()); ?>
            </p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!isset($articles) && isset($feeds) && !empty($feeds)) : ?>
        <div class="fluxs">
            <?php foreach($feeds as $feed) : ?>
            <div class="flux">
                <h2><?= $feed->getTitle() ?></h2>

                <a href="?target=feed&action=one"><img class="img-flux" src="<?= $feed->getPictureUrl() ?>" alt=""></a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </section>

<?php

?>
