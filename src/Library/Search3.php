<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 9:20 PM
 */

namespace SethPhat\Search3\Library;

use SethPhat\Search3\Library\Builder\SearchBuilder;
use SethPhat\Search3\Library\Exception\BuilderException;

/**
 * Class Search3 Factory
 * @package SethPhat\Search3\Library
 */
class Search3
{
    protected $hook_obj = null;

    protected $builder;

    public function __construct($main_group, $hook = null) {
        $this->builder = new SearchBuilder($main_group);

        if (!empty($hook)) {
            $this->initHook($hook);
        }
    }

    public function initHook($hook_name) {
        $hookClass = config('search3_hook.'.$hook_name, null);

        if (empty($hookClass)) {
            throw new BuilderException("HOOK DOESN'T EXISTED");
        }

        // create obj and set to builder
        $this->hook_obj = new $hookClass();
        $this->builder->setHookObj($this->hook_obj);
    }

    public function getResult($postData) {
        $this->builder->setSearchData($postData);
        $this->builder->build();
    }
}