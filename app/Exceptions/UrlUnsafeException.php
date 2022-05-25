<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class UrlUnsafeException extends Exception
{
	public function __construct(string $message = "The provided URL contains threatening content", int $code = 0, ?Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}