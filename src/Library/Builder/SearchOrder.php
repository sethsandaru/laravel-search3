<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-15
 * Time: 16:07
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;

class SearchOrder
{
    public function __construct($postData, Builder $builder) {
        if (!isset($postData['order'])) {
            return;
        }

        $order_place = $postData[0]['column'];
        $order_type = $postData[0]['dir'];
        $order_column = $postData[$order_place]['data'];

        if ($order_type == "asc") {
            $order_type = "ASC";
        } else {
            $order_type = "DESC";
        }

        $builder->orderBy($order_column, $order_type);
    }
}