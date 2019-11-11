<?php

namespace ObjectiaTest;

use Objectia\Client as Client;

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

    public function testClientWithNoApiKey()
    {
        try {
            $cli = new Client("");
            $this->fail();
        } catch (\InvalidArgumentException $e) {
            $this->assertNotNull($e);
        }
    }

    /* public function testGetUsage()
    {
    $usage = $this->client->usage->get();
    //var_dump($usage);
    $this->assertNotNull($usage);
    $this->assertNotNull($usage["geoip_requests"]);
    }
     */
    public function testGeolocationGet()
    {
        $location = $this->client->geolocation->get("8.8.8.8");
        var_dump($location);
        $this->assertNotNull($location);
        $this->assertEquals("US", $location["country_code"]);
    }

    /*  public function testSendMail()
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
}*/
}
