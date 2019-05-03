<?php

namespace Objectia;

require "vendor/autoload.php";

class Client
{
    // APIs
    public $usage;

    public function __construct($apiKey, $timeout = DEFAULT_TIMEOUT)
    {
        $restClient = new RestClient($apiKey, $timeout);
        $this->usage = new UsageAPI($restClient);
    }
}
