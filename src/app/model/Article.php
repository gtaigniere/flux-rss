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
    /**
     * @var int
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
    private $fluxId;

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
     * @return DateTime
     * @throws Exception
     */
    public function getReleaseDate(): DateTime
    {
        return new DateTime($this->releaseDate);
    }

    /**
     * @param DateTime $releaseDate
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
    public function getFluxId(): ?int
    {
        return $this->fluxId;
    }

    /**
     * @param int|null $fluxId
     */
    public function setFluxId(?int $fluxId): void
    {
        $this->fluxId = $fluxId;
    }

}
