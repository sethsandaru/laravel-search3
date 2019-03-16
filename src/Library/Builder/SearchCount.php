<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/16/2019
 * Time: 12:22 PM
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use SethPhat\Search3\Model\Eloquents\SearchGroup;

class SearchCount
{
    /**
     * @var SearchGroup $main_group
     */
    protected $main_group;

    /**
     * @var Builder $builder
     */
    protected $builder;

    public function __construct(SearchGroup $main_group, Builder $builder)
    {
        $this->builder = $builder;
        $this->main_group = $main_group;
    }

    public function getTotalRows() {
        if (!empty($this->main_group->MetaDataObject) && $this->main_group->MetaDataObject['count_type'] == 1) {
            $count = DB::select("SELECT FOUND_ROWS() AS COUNT");
            return intval($count[0]->COUNT);
        } else {
            //$this->builder->selectRaw("COUNT(*) AS COUNT");
            $count = $this->builder->count("*");
            return $count;
        }
    }
}