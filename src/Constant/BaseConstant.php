<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/1/2019
 * Time: 9:37 PM
 */

namespace SethPhat\Search3\Constant;


class BaseConstant
{
    const LIMIT_RECORD = 15;

    const COUNT_TYPES = [
        0 => "COUNT(*)",
        1 => "SQL_CALC_FOUND_ROWS"
    ];
}