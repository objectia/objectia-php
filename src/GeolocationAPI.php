<?php

namespace Objectia;

require "vendor/autoload.php";

class GeolocationAPI
{
    protected $restClient;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
    }

    public function get($ip)
    {
        return $this->restClient->get("/v1/geoip/" . $ip);
    }
}
