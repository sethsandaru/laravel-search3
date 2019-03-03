<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 2:20 PM
 */

namespace SethPhat\Search3\Controller\SearchRelation;


use SethPhat\Search3\Controller\BaseController;

class RelationController extends BaseController
{
    public function index() {
        $this->setNavTitle(trans("search3::relation.title"));

        return $this->view('search_relation.index');
    }
}