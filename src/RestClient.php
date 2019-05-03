<?php

namespace Objectia;

require_once "Constants.php";

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Objectia\Exceptions\APIConnectionException;
use Objectia\Exceptions\APITimeoutException;
use Objectia\Exceptions\ResponseException;

abstract class RestClient
{
    protected $apiKey;
    protected $http;

    public function __construct($apiKey, $timeout = DEFAULT_TIMEOUT)
    {
        $this->apiKey = $apiKey;

        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException("No API key provided");
        }

        $this->http = new HttpClient([
            "base_uri" => API_BASE_URL,
            "timeout" => $timeout,
        ]);
    }

    public function setHttpClient($httpClient)
    {
        $this->http = $httpClient;
    }

    protected function get($path)
    {
        return $this->execute("GET", $path);
    }

    protected function post($path, $params)
    {
        return $this->execute("POST", $path, $params);
    }

    protected function put($path, $params)
    {
        return $this->execute("PUT", $path, $params);
    }

    protected function patch($path, $params)
    {
        return $this->execute("PATCH", $path, $params);
    }

    protected function delete($path)
    {
        return $this->execute("DELETE", $path);
    }

    protected function execute($method, $path, $params = array())
    {
        $headers = [
            "Authorization" => "Bearer " . $this->apiKey,
            "User-Agent" => "objectia-php/" . VERSION,
            "Accept" => "application/json",
        ];

        if (!is_null($params)) {
            $headers["Content-Type"] = "application/json";
        }

        try {
            $response = $this->http->request($method, $path, [
                "headers" => $headers,
                "json" => $params,
            ]);
            return $response->getBody();
        } catch (ConnectException $e) {
            $reason = $e->getMessage();
            $pos = strpos($reason, "cURL error 28");
            if ($pos === false) {
                throw new APIConnectionException($reason);
            } else {
                throw new APITimeoutException($reason);
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $status = $response->getStatusCode();
                $message = $e->getMessage();

                $pieces = explode("\n", $message);
                if (count($pieces) > 1) {
                    $body = $pieces[1];
                    $error = Error::fromJSON($body);
                    if ($error->isValid()) {
                        throw new ResponseException($status, $error->message); //FIXME: code!!!
                    } else {
                        throw new ResponseException($status, $message);
                    }
                } else {
                    throw new ResponseException($status, $message);
                }
            } else {
                throw new APIConnectionException($e->getMessage());
            }
        }
    }
}
