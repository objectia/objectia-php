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

    /*
public function testGetUser()
{
$user = $this->client->getUser("123456");
$this->assertNotNull($user);
}

public function testGetUnknownUser()
{
try {
$user = $this->client->getUser("000000");
$this->fail();
} catch (ResponseException $e) {
$this->assertEquals(404, $e->getStatus());
}
}

public function testCreateUser()
{
$user = $this->client->createUser("jdoe@example.com", "+12125551234", 1);
$this->assertNotNull($user);
}

public function testCreateUserInvalidEmail()
{
try {
$user = $this->client->createUser("jdoeexample.com", "+12125551234", 1);
$this->fail();
} catch (ResponseException $e) {
$this->assertEquals(400, $e->getStatus());
}
}

public function testRemoveUser()
{
$user = $this->client->removeUser("123456");
$this->assertNotNull($user);
}

public function testRemoveUnknownUser()
{
try {
$user = $this->client->removeUser("000000");
$this->fail();
} catch (ResponseException $e) {
$this->assertEquals(404, $e->getStatus());
}
}

public function testRequestSms()
{
$receipt = $this->client->requestSms("123456");
$this->assertNotNull($receipt);
}

public function testRequestSmsUnknownUser()
{
try {
$receipt = $this->client->requestSms("000000");
$this->fail();
} catch (ResponseException $e) {
$this->assertEquals(404, $e->getStatus());
}
}

public function testRequestCall()
{
$receipt = $this->client->requestCall("123456");
$this->assertNotNull($receipt);
}

public function testRequestCallUnknownUser()
{
try {
$receipt = $this->client->requestCall("000000");
$this->fail();
} catch (ResponseException $e) {
$this->assertEquals(404, $e->getStatus());
}
}

public function testApiWhenServerIsDown()
{
try {
// Simulate server down
$httpClient = new HttpClient([
"base_uri" => "http://localhost:4444",
"timeout" => 10.0,
]);
$client = new Client($this->clientId, $this->clientSecret);
$client->setHttpClient($httpClient);
$user = $client->getUser("123456");
$this->fail();
} catch (APIConnectionException $e) {
$this->assertNotNull($e);
}
}

public function testApiWhenUsingFakeServer()
{
try {
// Simulate some kind of network problem
$httpClient = new HttpClient([
"base_uri" => "http://fakeserver:4000",
"timeout" => 10.0,
]);
$client = new Client($this->clientId, $this->clientSecret, true);
$client->setHttpClient($httpClient);
$user = $client->getUser("123456");
$this->fail();
} catch (APIConnectionException $e) {
$this->assertNotNull($e);
}
}

public function testError()
{
$error = new Error();
$error->status = 400;
$error->message = "Error messages";
$error->success = false;
$this->assertTrue($error->isValid());
}

public function testBadError()
{
$error = new Error();
$error->status = 0;
$error->message = "";
$error->success = false;
$this->assertFalse($error->isValid());
}
 */
}
