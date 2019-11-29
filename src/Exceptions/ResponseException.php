<?php

namespace Objectia\Exceptions;

class ResponseException extends APIException
{
    private $status;
    private $errCode; // $code is already used in Exception

    public function __construct($status, $message, $code = null, \Exception $previous = null)
    {
        $this->status = $status;
        $this->errCode = $code;
        parent::__construct($message, $previous);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getErrorCode()
    {
        return $this->errCode;
    }
}
