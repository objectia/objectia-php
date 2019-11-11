<?php

namespace Objectia;

require "vendor/autoload.php";

class Client
{
    // APIs
    public $usage;
    public $geolocation;
    public $mail;

    public function __construct($apiKey, $timeout = DEFAULT_TIMEOUT)
    {
        $restClient = new RestClient($apiKey, $timeout);
        $this->usage = new UsageAPI($restClient);
        $this->geolocation = new GeolocationAPI($restClient);
        $this->mail = new MailAPI($restClient);
    }
}
