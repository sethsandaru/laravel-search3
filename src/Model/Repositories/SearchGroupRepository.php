<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/1/2019
 * Time: 9:32 PM
 */

namespace SethPhat\Search3\Model\Repositories;


use SethPhat\Search3\Constant\BaseConstant;
use SethPhat\Search3\Model\Eloquents\SearchGroup;

class SearchGroupRepository
{
    /**
     * Get list data of search group
     * @param array $data
     * @param bool $paginate
     * @return SearchGroup[]
     */
    public function getList(array $data = [], $paginate = false) {
        $query = SearchGroup::query();

        if (isset($data['sort'])) {
            $query->orderBy($data['sort']['by'], $data['sort']['type']);
        }

        if (isset($data['limit'])) {
            $query->limit($data['limit']);
        }

        if (isset($data['keyword'])) {
            $query->where(function($qr) use ($data) {
                $qr->where('name', 'LIKE', '%' . $data['keyword'] . '%');
                $qr->orWhere('table_name', 'LIKE', '%' . $data['keyword'] . '%');
            });
        }

        if ($paginate) {
            return $query->paginate(BaseConstant::LIMIT_RECORD);
        }

        return $query->get();
    }

    /**
     * Get group by group name
     * @param $name
     */
    public function getByName($name) {
        $query = SearchGroup::query();
        $query->where('name', $name);
        return $query->first();
    }
}