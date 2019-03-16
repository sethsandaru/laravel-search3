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
        $main_group_fields = $this->main_group->Fields;
        foreach ($main_group_fields as $search_field) {
            $fields[] = $this->main_group->name . "." . $search_field->field_name;
        }

        // apply sub-group fields
        foreach ($this->tables as $table) {
            foreach ($table['table']->Fields as $search_field) {
                $fields[] = $table['table']->name . "." . $search_field->field_name;
            }
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
}