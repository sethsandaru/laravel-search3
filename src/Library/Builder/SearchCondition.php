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
            $column = str_replace(SearchFielder::FIELD_SEPARATE, ".", $key);

            switch ($this->_getType($value)){
                case 'array':
                    $builder->whereIn($column, json_decode($value, true));
                    break;
                case 'string':
                    $builder->where($column, 'LIKE', $value);
                    break;
                case 'number':
                default:
                    $builder->where($column, $value);
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