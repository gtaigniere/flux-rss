<?php


namespace App\Model;


use DateTime;
use Exception;

/**
 * Class Flux
 * @package Model
 */
class Flux
{
    /**
     * @var int
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
     */
    public function setLastBuildDate($lastBuildDate): void
    {
        $this->lastBuildDate = $lastBuildDate;
    }

}
