<?php


namespace App\Model;


use DateTime;
use Exception;

/**
 * Class Feed
 * @package Model
 */
class Feed
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * Url du flux RSS
     * @var string
     */
    private $feedUrl;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * Url du site
     * @var string
     */
    private $siteUrl;

    /**
     * @var DateTime
     */
    private $lastBuildDate;

    /**
     * @var Article[]
     */
    private $articles = [];

    /**
     * Feed constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFeedUrl(): string
    {
        return $this->feedUrl;
    }

    /**
     * @param string $feedUrl
     */
    public function setFeedUrl(string $feedUrl): void
    {
        $this->feedUrl = $feedUrl;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title != null ?$this->title : '';
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * @param string $siteUrl
     */
    public function setSiteUrl(string $siteUrl): void
    {
        $this->siteUrl = $siteUrl;
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getLastBuildDate()
    {
        return new DateTime($this->lastBuildDate);
    }

    /**
     * @param DateTime $lastBuildDate
     * @throws Exception
     */
    public function setLastBuildDate($lastBuildDate): void
    {
        $this->lastBuildDate = $lastBuildDate;
    }

    /**
     * @return Article[]
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @param Article[] $articles
     */
    public function setArticles(array $articles): void
    {
        $this->articles = $articles;
    }

    /**
     * @param $rss
     * @param $url
     * @return Feed
     */
    public static function createFeed($rss, $url): Feed
    {
        $feed = new Feed();
        $feed->id = isset($rss->id) ? $rss->id : null;
        $feed->feedUrl = $url;
        $feed->title = $rss->title != null ? $rss->title : '';
        $feed->description = $rss->description;
        $feed->siteUrl = $rss->link;
        $feed->lastBuildDate = $rss->lastBuildDate;
        return $feed;
    }

    /**
     * @param $url
     * @return Feed
     * @throws Exception
     */
    public static function fromUrl($url): Feed
    {
        $xml = file_get_contents($url);
        $rss = simplexml_load_string($xml);
        if ($rss && property_exists($rss, 'channel')) {
            $rss = $rss->channel;
            $feed = self::createFeed($rss, $url);
            $articles = [];
            foreach ($rss->item as $item) {
                $articles[] = Article::createArticleFromFeed($item);
            }
            $feed->setArticles($articles);
            return $feed;
        }
        throw new Exception("Le flux demandé n'a pas été trouvé");
    }

}
