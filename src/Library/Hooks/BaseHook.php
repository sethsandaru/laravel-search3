<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-04
 * Time: 16:40
 */

namespace SethPhat\Search3\Library\Hooks;


use SethPhat\Search3\Library\Interfaces\ISearchHook;
use SethPhat\Search3\Library\Search3;

abstract class BaseHook implements ISearchHook
{
    protected $search3;

    public function __construct(Search3 $search3) {
        $this->search3 = $search3;
    }
}