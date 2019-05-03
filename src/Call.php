<?php

namespace Objectia;

use MintWare\JOM\JsonField;
use MintWare\JOM\ObjectMapper;

class Call
{
    /** @JsonField(name="phone", type="string") */
    public $phone;

    /** @JsonField(name="ignored", type="bool") */
    public $ignored;

    /**
     * Create a call object from a JSON string.
     *
     * @param string $body
     * @return Call
     */
    public static function fromJSON($body)
    {
        // Extract and use the data part only
        $data = json_decode($body, true);
        $str = json_encode($data['data']);
        $mapper = new ObjectMapper();
        return $mapper->mapJson($str, Call::class);
    }
}
