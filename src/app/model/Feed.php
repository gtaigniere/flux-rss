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
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var DateTime
     */
    private $lastBuildDate;

    /**
     * @var string|null
     */
    private $pictureUrl;

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
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website): void
    {
        $this->website = $website;
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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
     * @return string|null
     */
    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    /**
     * @param string|null $pictureUrl
     */
    public function setPictureUrl(?string $pictureUrl): void
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * @param $rss
     * @return Feed
     */
    public function createFeed($rss): Feed
    {
        $this->id = isset($rss->id) ? $rss->id : null;
        $this->website = $rss->title;
        $this->description = $rss->description;
        $this->url = $rss->link;
        $this->lastBuildDate = $rss->lastBuildDate;
        $this->pictureUrl = isset($rss->pictureUrl) ? $rss->pictureUrl : null;
        return $this;
    }

    /**
     * @param $rss
     * @return Feed
     */
    public static function feedFromUrl($rss): Feed
    {
        $feed = new Feed();
        $feed->id = isset($rss->id) ? $rss->id : null;
        $feed->website = $rss->title;
        $feed->description = $rss->description;
        $feed->url = $rss->link;
        $feed->lastBuildDate = $rss->lastBuildDate;
        $feed->pictureUrl = isset($rss->pictureUrl) ? $rss->pictureUrl : null;;
        return $feed;
    }

}
