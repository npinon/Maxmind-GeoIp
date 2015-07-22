# Maxmind GeoIp2 Symfony Bundle #

To install this bundle please follow the next steps:

First add the dependencie to your `composer.json` file:

```json
"require": {
    ...
    "maxmind/geoip": "dev-master"
},
```

Then install the bundle with the command:

```sh
php composer update
```

Enable the bundle in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Maxmind\Bundle\GeoipBundle\MaxmindGeoipBundle(),
    );
}
```

Now the bundle is installed.

First you have to install the dabase file.

You can simply execute this command:

```sh
php app/console maxmind:geoip:downloadpackage %url-data-source%
```

Replace %url-data-source% with the url of the needed data source (gz format).
ex: http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz

Or you can download the free version here:
http://dev.maxmind.com/geoip/geoip2/geolite2/
Then you have to unpack it into directory located in 'app/Resources/geodb/'.

If you want to use your data file in another directory, you can configure it on `app\config\config.yml`
You can also configure the name of the file and the language of the displayed values.

```yaml
# app/config/config.yml
maxmind_geoip:
    data_file_path:             "%kernel.root_dir%/Resources/geodb/"
    data_file_name:             "GeoLite2-City.mmdb"
    language:                   fr
```

Now can use the Maxmind GeoIp2 Library everywhere in your Symfony2 application.

Usage
-----

The following exemples are available if you are in a controller

```php
$geoip = $this->get('maxmind.geoip')->getRecord($miscIP);

$geoip->getCity();
$geoip->getCountry();
$geoip->getCountryCode();
$geoip->getPostalCode();
$geoip->getLatitude();
$geoip->getLongitude();
$geoip->getAreaCode();
$geoip->getContinent();
$geoip->getContinentCode();
$geoip->getMostSpecificSubdivision()
```

This bundle use Maxmind GeoIp2 API,
you can find at https://github.com/maxmind/GeoIP2-php
