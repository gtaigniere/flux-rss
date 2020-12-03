<?php
$url = "https://www.clubic.com/feed/news.rss";
$rss = simplexml_load_file($url);

if (isset($rss)) {
?>

    <section role="main" class="container">

        <h1>Flux RSS</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Un flux (rss)</h3>
                <p><a href="<?= $rss->channel->url ?>"><?= $rss->channel->title ?></a><br>
                <?= $rss->channel->description ?><br>
                <?= $rss->channel->lastBuildDate ?></p>

                <h3>Un article (item)</h3>
                <p><a href="<?= $rss->channel->item[0]->link ?>"><?= $rss->channel->item[0]->title ?></a><br>
                    <?= $rss->channel->item[0]->description ?><br>
                    <?= $rss->channel->item[0]->category ?><br>
                    <?= $rss->channel->item[0]->pubDate ?><br>
                    <img class="img-item" src="<?= $rss->channel->item[0]->enclosure['url']; ?>" alt=""></p>
            </div>
        </div>

    </section>

<?php
}
?>
