<?php
namespace Gallerie\Application;

use Exception;

class ApplicationException extends Exception
{
  // Constructor
  public function __construct($message, $code = 500, Exception $previous = null)
  {
    parent::__construct($message,$code,$previous);
  }
}
