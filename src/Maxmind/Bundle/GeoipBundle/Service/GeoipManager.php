<?php

namespace Maxmind\Bundle\GeoipBundle\Service;

use GeoIp2\Database\Reader;

class GeoipManager
{
    protected $filePath;

    protected $fileName;

    protected $locale;

    protected $geoip2;

    protected $record;

    public function __construct($filePath, $fileName, $locale)
    {
        $this->locale = $locale;
        $this->database = $filePath.$fileName;
        $this->geoip2 = new Reader($this->database);
    }

    public function getRecord($ipAddress)
    {
        $this->record = $this->geoip2->city($ipAddress);

        if ($this->record)
        {
            return $this;
        }

        return false;
    }

    public function getCity()
    {
        if ($this->record)
        {
            return $this->record->city->name;
        }

        return false;
    }

    public function getContinent()
    {
        if ($this->record)
        {
            return $this->record->continent->names[$this->locale];
        }

        return false;
    }

    public function getContinentCode()
    {
        if ($this->record)
        {
            return $this->record->continent->code;
        }

        return false;
    }

    public function getCountry()
    {
        if ($this->record)
        {
            return $this->record->country->names[$this->locale];
        }

        return false;
    }

    public function getCountryCode()
    {
        if ($this->record)
        {
            return $this->record->country->isoCode;
        }

        return false;
    }

    public function getPostalCode()
    {
        if ($this->record)
        {
            return $this->record->postal->code;
        }

        return false;
    }

    public function getLatitude()
    {
        if ($this->record)
        {
            return $this->record->location->latitude;
        }

        return false;
    }

    public function getLongitude()
    {
        if ($this->record)
        {
            return $this->record->location->longitude;
        }

        return false;
    }

    public function getAreaCode()
    {
        if ($this->record)
        {
            return $this->record->mostSpecificSubdivision->isoCode;
        }

        return false;
    }

    public function getMostSpecificSubdivision()
    {
        if ($this->record)
        {
            return $this->record->mostSpecificSubdivision->names[$this->locale];
        }

        return false;
    }
}
