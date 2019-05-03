<?php

namespace Objectia;

require "vendor/autoload.php";

class UsageAPI
{
    protected $restClient;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
    }

    public function get()
    {
        return $this->restClient->get("usage");
    }
}
