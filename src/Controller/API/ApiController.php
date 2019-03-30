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
use SethPhat\Search3\Library\Search3;

class ApiController extends BaseController
{
    public function lookup(Request $rq) {
        $postData = $rq->all();

        $main_group = $postData['main_group'];
        $server_hook = $postData['server_hook'] ?? null;

        if (empty($main_group)) {
            return $this->returnError('MAIN GROUP IS MISSING');
        }

        // build here...
        $search3 = new Search3($main_group, $server_hook);

        try {
            // retrieve data & return
            $result = $search3->getResult($postData);
            return $this->returnJson($result);
        } catch (\Exception $e) {
            var_dump($e);exit;
            return $this->returnJson([
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
                'code' => 400,
                'message' =>'ERROR WHILE RETRIEVE DATA: ' . $e->getMessage(),
            ]);
        }
    }
}