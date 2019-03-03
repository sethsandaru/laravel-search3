<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 10:39 AM
 */

namespace SethPhat\Search3\Library\Interfaces;


interface ISearchHook
{
    public function beforeBuildQuery(&$postData);
    public function afterBuiltQuery($query_builder, $postData);
    public function afterQueryResult(&$result);
}