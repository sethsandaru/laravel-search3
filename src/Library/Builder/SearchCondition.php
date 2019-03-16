<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-15
 * Time: 16:07
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;

class SearchCondition
{
    public function __construct($postData, Builder $builder) {
        if (!isset($postData['filter'])) {
            return;
        }

        foreach ($postData['filter'] as $key => $value) {
            switch ($this->_getType($value)){
                case 'array':
                    $builder->whereIn($key, json_decode($value, true));
                    break;
                case 'string':
                    $builder->where($key, 'LIKE', $value);
                    break;
                case 'number':
                default:
                    $builder->where($key, $value);
                    break;
            }
        }
    }

    private function _getType($value) {
        if ($value[0] == "[") {
            return "array";
        }
        if (is_numeric($value)) {
            return "number";
        }

        return "string";
    }
}