<?php

namespace Objectia;

require "vendor/autoload.php";

class MailAPI
{
    protected $restClient;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
    }

    public function send($message)
    {
        $headers = [
            "Content-Type" => "multipart/form-data",
        ];

        $form = array();
        foreach ($message as $key => $value) {
            if ($key == "attachments") {
                // Files
                foreach ($value as $fn) {
                    $param = [
                        "name" => basename($fn),
                        "contents" => fopen($fn, "rb"),
                    ];
                    array_push($form, $param);
                }
            } else {
                // Fields
                if (is_array($value)) {
                    foreach ($value as $item) {
                        $param = [
                            "name" => $key,
                            "contents" => $item,
                        ];
                        array_push($form, $param);
                    }
                } else {
                    $param = [
                        "name" => $key,
                        "contents" => $value,
                    ];
                    array_push($form, $param);
                }
            }
        }
        return $this->restClient->post("/v1/mail/send", $form, $headers);
    }
}
