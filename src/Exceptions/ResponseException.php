<?php

namespace Objectia\Exceptions;

class ResponseException extends APIException
{
    private $status;

    public function __construct($status, $message, $code = 0, \Exception $previous = null)
    {
        $this->status = $status;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus()
    {
        return $this->status;
    }
}
