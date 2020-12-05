<?php


namespace Model;


use DateTime;
use Exception;

/**
 * Class Flux
 * @package Model
 */
class Flux
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
     * Flux constructor.
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
     * @return DateTime|string
     */
    public function getLastBuildDate()
    {
        return $this->lastBuildDate;
    }

    /**
     * @param DateTime|string $lastBuildDate
     * @throws Exception
     */
    public function setLastBuildDate($lastBuildDate): void
    {
        if ($lastBuildDate instanceof DateTime) {
            $this->lastBuildDate = $lastBuildDate;
        } elseif (is_string($lastBuildDate)) {
            $this->lastBuildDate = DateTime::createFromFormat('Y-m-d H:i:s', $lastBuildDate);
        } else {
            throw new Exception('Une date au format Datetime ou string doit être fournie !');
        }
    }

    /**
     * Permet de créer un Flux
     * @param $rss
     * @return Flux
     */
    public static function flowFromUrl($rss): Flux
    {
        $flux = new Flux();
        $flux->website = $rss->title;
        $flux->description = $rss->description;
        $flux->url = $rss->link;
        $flux->lastBuildDate = $rss->lastBuildDate;
        return $flux;
    }

}
