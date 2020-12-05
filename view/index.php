<?php
$url = "https://www.clubic.com/feed/news.rss";
$rss = simplexml_load_file($url)->channel;
?>

    <section class="sect-home">

        <h1>Flux RSS</h1>
        <form action="/index.php" method="POST">
            <input type="text" name="url" placeholder="Adresse du flux" required>
            <button class="btn btn-success" type="submit">Envoyer</button>
        </form>

        <h2><?= $rss->description ?></h2>
        <div class="articles">
            <?php foreach($rss->item as $item) : ?>
            <p class="article">
                <img class="img-item" src="<?= $item->enclosure['url']; ?>" alt="">
                <a href="<?= $item->link; ?>"><span class="title"><?= $item->title; ?></span></a><br>
                <?= strip_tags($item->description); ?>
            </p>
            <?php endforeach; ?>
        </div>

    </section>

<?php

?>
