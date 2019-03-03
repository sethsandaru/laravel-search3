<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 2:22 PM
 */

namespace SethPhat\Search3\Controller\API;


use Illuminate\Http\Request;
use SethPhat\Search3\Controller\BaseController;

class ApiController extends BaseController
{
    public function lookup(Request $rq) {
        $postData = $rq->all();

        // build here...


        // set result
    }
}