<?php
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

    </section>

<?php

?>
