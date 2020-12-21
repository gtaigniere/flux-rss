<?php

use App\Util\ErrorManager;

/*
 * https://www.clubic.com/feed/news.rss
 * http://www.metal-impact.com/rss.xml
 *
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

        <form action="?target=feed&action=url" method="POST">
            <label for="feed" >Flux à afficher : </label>
            <input type="text" id="feed" name="url" placeholder="Adresse web" required>
            <button class="btn btn-success" type="submit">Envoyer</button>
        </form>

        <?php if (isset($feed, $articles)) : ?>
        <h2><?= $feed->getDescription() ?></h2>
        <div class="articles">
            <?php foreach($articles as $article) : ?>
            <p class="article">
                <a href="<?= $article->getLink(); ?>">
                    <img class="img-item" src="<?= $article->getPictureLink(); ?>" alt="">
                </a>
                <span class="title"><?= $article->getTitle(); ?></span><br>
                <?= strip_tags($article->getDescription()); ?>
            </p>
            <?php endforeach; ?>
        </div>
            <form action="?target=feed&action=add" method="POST">
                <label for="url" >Flux à ajouter : </label>
                <input type="text" id="url" name="url" <?= !empty($feed->getUrl()) ? 'value="' . $feed->getUrl() . '"' : ''; ?> placeholder="Adresse du flux" required>
                <button class="btn btn-primary" type="submit">Valider</button>
            </form>
        <?php endif; ?>

        <?php if (!isset($articles) && isset($feeds) && !empty($feeds)) : ?>
        <div class="fluxs">
            <?php foreach($feeds as $feed) : ?>
            <div class="flux">
                <h2><?= $feed->getWebsite() ?></h2>

                <form action="" method="POST">
                    <label for="url" >Flux à ajouter : </label>
                    <input type="text" id="url" name="url" placeholder="Adresse web" required>
                    <button class="btn btn-success" type="submit">Envoyer</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </section>

<?php

?>
