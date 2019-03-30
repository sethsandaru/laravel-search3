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

        $order_place = $postData['order'][0]['column'];
        $order_type = $postData['order'][0]['dir'];
        $order_column = $postData['columns'][$order_place]['data'];
        $column = str_replace(SearchFielder::FIELD_SEPARATE, ".", $order_column);

        if ($order_type == "asc") {
            $order_type = "ASC";
        } else {
            $order_type = "DESC";
        }

        $builder->orderBy($column, $order_type);
    }
}