<?php


namespace Model;


use DateTime;
use Exception;

/**
 * Class Article
 * @package Model
 */
class Article
{

    /***
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string&
     */
    private $description;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
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
     * @var int
     */
    private $rssId;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
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
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return DateTime|string
     */
    public function getReleaseDate(): DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param DateTime $releaseDate
     * @throws Exception
     */
    public function setReleaseDate(DateTime $releaseDate): void
    {
        if ($releaseDate instanceof DateTime) {
            $this->releaseDate;
        } elseif (is_string($releaseDate)) {
            $this->releaseDate = DateTime::createFromFormat('Y-m-d H:i:s', $releaseDate);
        } else {
            throw new Exception('Une date au format Datetime ou string doit être fournie !');
        }
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
    public function getRssId(): ?int
    {
        return $this->rssId;
    }

    /**
     * @param int|null $rssId
     */
    public function setRssId(?int $rssId): void
    {
        $this->rssId = $rssId;
    }

}
