<?php
use App\Util\ErrorManager;
?>

    <section class="sect-articles">

        <h1><?= isset($orphan) && $orphan ? 'Articles orphelins' : 'Tous les Articles' ?></h1>

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

        <?php if (isset($articles)) : ?>
        <div class="articles">
            <?php foreach($articles as $article) : ?>
                <div class="article">
                    <p>
                        <a href="<?= $article->getLink() ?>">
                            <img class="img-item" src="<?= $article->getPictureLink() ?>" alt="">
                        </a>
                    </p>
                    <div>
                        <p class="title">
                            <a href="<?= $article->getLink() ?>"><?= $article->getTitle() ?></a>
                        </p>
                        <p class="description"><?= strip_tags($article->getDescription()) ?></p>
                    </div>
                    <p class="trash"><a class="btn btn-danger" href="?target=article&action=del&id=<?= $article->getId() ?>"><i class="fas fa-trash-alt"></i></a></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($article) &&  isset($orphan) && $orphan) : ?>
        <form action="?target=article&action=del" method="POST">
            <button class="btn btn-danger" name="orphans" value="true">Supprimer tous les articles orphelins</button>
        </form>
        <?php endif; ?>

    </section>

<?php

?>
