<?php


namespace App\Model;


use DateTime;
use Exception;

/**
 * Class Article
 * @package Model
 */
class Article
{
    /***
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string|null
     */
    private $category;

    /**
     * @var DateTime
     */
    private $releaseDate;

    /**
     * @var string|null
     */
    private $pictureLink;

    /**
     * @var int|null
     */
    private $feedId;

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
    public function getTitle(): string
    {
        return $this->title;
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
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getReleaseDate(): DateTime
    {
        return new DateTime($this->releaseDate);
    }

    /**
     * @param DateTime $releaseDate
     * @throws Exception
     */
    public function setReleaseDate(DateTime $releaseDate): void
    {
        $this->releaseDate;
    }

    /**
     * @return string|null
     */
    public function getPictureLink(): ?string
    {
        return $this->pictureLink;
    }

    /**
     * @param string|null $pictureLink
     */
    public function setPictureLink(?string $pictureLink): void
    {
        $this->pictureLink = $pictureLink;
    }

    /**
     * @return int|null
     */
    public function getFeedId(): ?int
    {
        return $this->feedId;
    }

    /**
     * @param int|null $feedId
     */
    public function setFeedId(?int $feedId): void
    {
        $this->feedId = $feedId;
    }

    /**
     * @param $item
     * @param $feedId
     * @return Article
     */
    public static function createArticleFromFeed($item, $feedId = null): Article
    {
        $article = new Article();
        $article->id = isset($item->id) ? $item->id : null;
        $article->title = $item->title;
        $article->description = $item->description;
        $article->link = $item->link;
        $article->category = isset($item->category) ? $item->category : null;
        $article->releaseDate = $item->pubDate;
        $article->pictureLink = isset($item->enclosure['url']) ? $item->enclosure['url'] : null;
        $article->feedId = $feedId;
        return $article;
    }

}
