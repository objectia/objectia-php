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

    public function get($ip, $options = array())
    {
        $query = http_build_query($options);
        if (!empty($query)) {
            $query = "?" . $query;
        }
        //var_dump($query);
        return $this->restClient->get("/v1/geoip/" . $ip . $query);
    }

    public function getCurrent($options = array())
    {
        return $this->get("myip", $options);
    }

    public function getBulk($ip_list, $options = array())
    {
        $ip = implode(",", $ip_list);
        return $this->get($ip, $options);
    }
}
