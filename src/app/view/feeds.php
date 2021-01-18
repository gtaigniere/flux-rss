<?php
use App\Util\ErrorManager;
?>

<section class="sect-feeds">

    <h1>Fluxs en base</h1>

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

    <?php if (isset($feeds)) : ?>
    <div class="fluxs">
        <?php foreach($feeds as $feed) : ?>
            <div class="flux">
                <h2><a href="?target=feed&action=one&id=<?= $feed->getId() ?>"><?= $feed->getTitle() ?></a></h2>
                <a class="btn btn-warning" href=""><i class="fas fa-marker"></i></a>
                <a class="btn btn-danger" href="?target=feed&action=del&id=<?= $feed->getId() ?>"><i class="fas fa-trash-alt"></i></a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</section>

<?php

?>
