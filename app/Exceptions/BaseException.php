<?php

namespace App\Exceptions;

use Exception;

/**
 * Base exception class that exists for right handling of error answers
 */
final class BaseException extends Exception
{
    /**
     * @param string $message Message of your exception. It could be provided for the user, so have to clear and readable
     * @param int $code Code of the exception, should be HTTP supportable
     * @param Exception|null $previous Previous exception, that can be a hint for developer
     */
    public function __construct(string $message = "", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
