<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/30/2019
 * Time: 11:05 AM
 */

namespace SethPhat\Search3\Controller;


class TestController extends BaseController
{
    public function index() {
        return $this->view('test.index');
    }
}