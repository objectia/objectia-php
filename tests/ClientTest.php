<?php

namespace ObjectiaTest;

use Objectia\Client as Client;
use Objectia\Exceptions\ResponseException;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    protected $httpClient;
    protected $client;
    protected $apiKey;

    public function setUp()
    {
        $this->apiKey = getenv("OBJECTIA_APIKEY");
        $this->client = new Client($this->apiKey, true);
    }

    public function testGetVersion()
    {
        $version = $this->client->getVersion();
        $this->assertEquals(VERSION, $version);
    }

    public function testGetUsage()
    {
        $usage = $this->client->usage->get();
        //var_dump($usage);
        $this->assertNotNull($usage);
        $this->assertNotNull($usage["geoip_requests"]);
    }

    public function testGetGeolocation()
    {
        $location = $this->client->geolocation->get("8.8.8.8");
        //var_dump($location);
        $this->assertNotNull($location);
        $this->assertEquals("US", $location["country_code"]);
    }

    public function testGetGeolocationWithOptions()
    {
        $options = array(
            "fields" => "country_code,hostname", // no spaces!
            "hostname" => "true", // must use string not bool!
        );
        $location = $this->client->geolocation->get("8.8.8.8", $options);
        //var_dump($location);
        $this->assertNotNull($location);
        $this->assertEquals("US", $location["country_code"]);
    }

    public function testGetCurrentGeolocation()
    {
        $location = $this->client->geolocation->getCurrent();
        //var_dump($location);
        $this->assertNotNull($location);
        $this->assertEquals("LT", $location["country_code"]);
    }

    public function testGetBulkGeolocation()
    {
        $location = $this->client->geolocation->getBulk(["8.8.8.8", "apple.com"]);
        $this->assertNotNull($location);
        $this->assertEquals(2, count($location));
        foreach ($location as $loc) {
            $this->assertEquals("US", $loc["country_code"]);
        }
    }

    public function testGetGeolocationWithInvalidInput()
    {
        try {
            $location = $this->client->geolocation->get("x");
            $this->asserNull($location);
        } catch (ResponseException $e) {
            $this->assertEquals(400, $e->getStatus());
            $this->assertEquals("err-invalid-ip", $e->getErrorCode());
            $this->assertEquals("Invalid IP address", $e->getMessage());
        }
    }

    public function testSendMail()
    {
        $message = [
            "from" => "ok@demo2.org",
            "to" => ["ok@demo2.org"],
            "subject" => "PHP test",
            "text" => "This is just a test",
            "attachments" => ["/Users/otto/me.png"],
        ];
        $receipt = $this->client->mail->send($message);
        //var_dump($receipt);
        $this->assertNotNull($receipt);
        $this->assertEquals(1, $receipt["accepted_recipients"]);
    }
}
