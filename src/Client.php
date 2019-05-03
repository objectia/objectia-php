<?php

namespace Objectia;

require "vendor/autoload.php";

class Client extends RestClient
{
    public function createUser($email, $phone, $countryCode, $sendInstallLink = false)
    {
        $params = [
            "email" => $email,
            "phone" => $phone,
            "country_code" => $countryCode,
            "send_install_link" => $sendInstallLink,
        ];

        $body = $this->post("/users", $params);
        return User::fromJSON($body);
    }

    public function getUser($userId)
    {
        $body = $this->get("/users/" . urlencode($userId));
        return User::fromJSON($body);
    }

    public function requestSms($userId, $force = false)
    {
        $params = [
            "force" => $force,
        ];
        $body = $this->post("/users/" . urlencode($userId) . "/sms", $params);
        return Sms::fromJSON($body);
    }

    public function requestCall($userId, $force = false)
    {
        $params = [
            "force" => $force,
        ];
        $body = $this->post("/users/" . urlencode($userId) . "/call", $params);
        return Call::fromJSON($body);
    }

    public function removeUser($userId)
    {
        $body = $this->delete("/users/" . urlencode($userId));
        return User::fromJSON($body);
    }
}
