<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-04
 * Time: 16:35
 */

namespace SethPhat\Search3\Model\Repositories;


use SethPhat\Search3\Constant\BaseConstant;
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
                'table' => $joined_table->JoinedTable,
                'type' => (int) $joined_table->type,
                'condition' => $joined_table->condition
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
                'table' => $join_table->JoinedTable,
                'type' => (int) $join_table->type,
                'condition' => $join_table->condition
            ];

            $this->_childJoin($tables, $join_table->join_group_id, $next_level);
        }
    }

    /**
     * @param $base_group_id
     * @return SearchRelation[]
     */
    public function getJoin($base_group_id) {
        $query = SearchRelation::query()->with(['BaseJoinTable', 'JoinedTable']);
        $query->where('base_group_id', $base_group_id);

        return $query->get();
    }

    /**
     * Get list data of search relation
     * @param array $data
     * @param bool $paginate
     * @return SearchRelation[]
     */
    public function getList(array $data = [], $paginate = false) {
        $query = SearchRelation::query();

        if (isset($data['sort'])) {
            $query->orderBy($data['sort']['by'], $data['sort']['type']);
        }

        if (isset($data['limit'])) {
            $query->limit($data['limit']);
        }

        if (isset($data['keyword']) && !empty($data['keyword'])) {
            $query->orWhereHas('BaseJoinTable', function ($base_table_query) use ($data) {
                $base_table_query->where('name', 'LIKE', '%' . $data['keyword'] . '%');
            });

            $query->orWhereHas('JoinedTable', function ($joined_table_query) use ($data) {
                $joined_table_query->where('name', 'LIKE', '%' . $data['keyword'] . '%');
            });
        }

        if ($paginate) {
            return $query->paginate(BaseConstant::LIMIT_RECORD);
        }

        return $query->get();
    }
}