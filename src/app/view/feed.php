<?php
use App\Util\ErrorManager;
?>

<section class="sect-feed">

    <h1>Un flux</h1>

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

    <?php if (isset($feed, $articles)) : ?>
    <h2><?= $feed->getDescription() ?></h2>
    <div class="articles">
        <?php foreach($articles as $article) : ?>
            <p class="article">
                <a href="<?= $article->getLink() ?>">
                    <img class="img-item" src="<?= $article->getPictureLink() ?>" alt="">
                </a>
                <a href="<?= $article->getLink() ?>">
                    <span class="title"><?= $article->getTitle() ?></span></a><br>
                <?= strip_tags($article->getDescription()) ?>
            </p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</section>

<?php

?>
