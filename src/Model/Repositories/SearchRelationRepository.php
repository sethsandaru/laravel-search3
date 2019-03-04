<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-04
 * Time: 16:35
 */

namespace SethPhat\Search3\Model\Repositories;


use SethPhat\Search3\Model\Eloquents\SearchGroup;
use SethPhat\Search3\Model\Eloquents\SearchRelation;

class SearchRelationRepository
{

    /**
     * @param integer $main_group_id
     * @return array
     */
    public function getJoinTable($main_group_id) {
        $join = [];

        // main group join to sub table
        $base_join = $this->getJoin($main_group_id);
        foreach ($base_join as $joined_table) {
            $join[] = [
                'table' => $joined_table->JoiningTable,
                'type' => $joined_table->type
            ];
            $this->_childJoin($join, $joined_table->join_group_id);
        }

        return $join;
    }

    private function _childJoin(&$tables, $child_group_id, $level = 2) {
        // max level reached or not
        if ($level == config('search3.max_join_level')) {
            return;
        }

        // get join table
        $join_tables = $this->getJoin($child_group_id);
        if ($join_tables->count() <= 0) {
            return;
        }

        $next_level = $level + 1;
        foreach ($join_tables as $join_table) {
            $tables[] =  [
                'table' => $join_table->JoiningTable,
                'type' => $join_table->type
            ];

            $this->_childJoin($tables, $join_table->join_group_id, $next_level);
        }
    }

    /**
     * @param $base_group_id
     * @return SearchRelation[]
     */
    public function getJoin($base_group_id) {
        $query = SearchRelation::query();
        $query->where('base_group_id', $base_group_id);

        return $query->get();
    }
}