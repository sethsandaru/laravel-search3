<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-04
 * Time: 17:05
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;
use SethPhat\Search3\Model\Eloquents\SearchGroup;

class SearchFielder
{
    const FIELD_SEPARATE = "__";

    protected $tables;

    protected $fields;

    /**
     * @var SearchGroup $main_group
     */
    protected $main_group;

    /**
     * @var Builder $builder
     */
    protected $builder;

    public function __construct(SearchGroup $main_group, array $tables, Builder $builder) {
        $this->tables = $tables;
        $this->builder = $builder;
        $this->main_group = $main_group;

        $this->applyField();
    }

    private function applyField() {
        $fields = [];

        // apply main group first
        $this->_setField($fields, $this->main_group);

        // apply sub-group fields
        foreach ($this->tables as $table) {
            $this->_setField($fields, $table['table']);
        }

        $this->fields = $fields;

        // final binding
        $select_sql = "";
        if (!empty($this->main_group->MetaDataObject) && $this->main_group->MetaDataObject['count_type'] == 1) {
            $select_sql = "SQL_CALC_FOUND_ROWS ";
        }

        $select_sql .= implode(",", $fields);

        // select
        $this->builder->selectRaw($select_sql);
    }

    private function _setField(&$fields, SearchGroup $groupObj) {
        foreach ($groupObj->Fields as $search_field) {
            $field_name = $groupObj->name . "." . $search_field->field_name;
            $field_name .= " AS `{$groupObj->name}" . static::FIELD_SEPARATE . "{$search_field->field_name}`";
            $fields[] = $field_name;
        }
    }
}