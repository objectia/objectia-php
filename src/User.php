<?php

namespace Objectia;

use MintWare\JOM\JsonField;
use MintWare\JOM\ObjectMapper;

class User
{
    /** @JsonField(name="id", type="string") */
    public $id;

    /** @JsonField(name="phone", type="string") */
    public $phone;

    /** @JsonField(name="email", type="string") */
    public $email;

    /** @JsonField(name="country_code", type="int") */
    public $country_code;

    /** @JsonField(name="registered", type="bool") */
    public $registered;

    /** @JsonField(name="confirmed", type="bool") */
    public $confirmed;

    /**
     * Create a user object from a JSON string.
     *
     * @param string $body
     * @return User
     */
    public static function fromJSON($body)
    {
        // Extract and use the data part only
        $data = json_decode($body, true);
        $str = json_encode($data['data']);
        $mapper = new ObjectMapper();
        return $mapper->mapJson($str, User::class);
    }
}
