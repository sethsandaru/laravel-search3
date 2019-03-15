<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-15
 * Time: 16:07
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;

class SearchPaging
{
    public function __construct($postData, Builder $builder) {
        $start = $postData['start'] ?? 0;
        $limit = $postData['limit'] ?? config('search3.limit_record');

        $builder->offset($start);
        $builder->limit($limit);
    }
}