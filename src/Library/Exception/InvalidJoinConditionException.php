<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 6/29/2019
 * Time: 11:08 AM
 */

namespace SethPhat\Search3\Library\Exception;


use Throwable;

class InvalidJoinConditionException extends \Exception
{
    const ERROR_CODE = 6979;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct("INVALID JOIN CONDITION DATA. ABORTED", static::ERROR_CODE, $previous);
    }
}