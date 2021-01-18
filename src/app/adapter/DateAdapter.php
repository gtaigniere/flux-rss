<?php


namespace App\Adapter;


use DateTime;

class DateAdapter
{
    const DATETIME_FORMAT_FRANCE = 'd/m/Y H:i';

    /**
     * Renvoie
     * @param DateTime $date
     * @return string
     */
    public static function toString(DateTime $date): string
    {
        return $date->format(self::DATETIME_FORMAT_FRANCE);
    }

    /**
     * @param string $date
     * @return DateTime
     */
    public static function toDateTime(string $date): DateTime
    {
        return Datetime::createFromFormat(self::DATETIME_FORMAT_FRANCE, $date);
    }

    /**
     * Renvoie la date passée en paramètre,
     * en français sous la forme (exemple : Lundi 15 Mai 2020)
     * @param DateTime $date
     * @return string
     */
    public static function toShortDateFr(DateTime $date): string
    {
        $date = $date->format('Y-m-d');
        setlocale(LC_TIME, "fr_FR", "fra");
        return strftime("%A %d %B %G", strtotime($date));
    }

}
