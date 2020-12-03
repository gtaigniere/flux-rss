<?php

$url = "https://www.clubic.com/feed/news.rss";
$rss = simplexml_load_file($url);

//$feedlist = new Flux("https://www.clubic.com/feed/news.rss");
//echo $feedlist->displayFlux(50,"News Clubic.com");

//if (isset($rss, $articles)) {
?>

    <section role="main" class="container">

        <h1>Flux RSS</h1>
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($rss->channel->item as $item) : ?>
                <p><a href="<?= $item->link; ?>"><span class="title"><b><?= $item->title; ?></b></span></a>
                <br><span class="description"><?= strip_tags($item->description); ?></span></p>
                <img class="img-item" src="<?= $item->enclosure['url']; ?>" alt=""><br>
                <?php endforeach; ?>
            </div>
        </div>

    </section>

<?php
//}
?>

