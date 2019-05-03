<?php

namespace Objectia;

use MintWare\JOM\JsonField;
use MintWare\JOM\ObjectMapper;

class Error
{
    /** @JsonField(name="status", type="int") */
    public $status;

    /** @JsonField(name="message", type="string") */
    public $message;

    /** @JsonField(name="success", type="bool") */
    public $success;

    /** @JsonField(name="code", type="string") */
    public $code;

    /**
     * Create a error object from a JSON string.
     *
     * @param string $body
     * @return Error
     */
    public static function fromJSON($body)
    {
        $mapper = new ObjectMapper();
        return $mapper->mapJson($body, Error::class);
    }

    /**
     * Check if error is valid.
     *
     * @return Bool
     */
    public function isValid()
    {
        if ($this->status === 0 || empty($this->message)) {
            return false;
        }
        return true;
    }
}
