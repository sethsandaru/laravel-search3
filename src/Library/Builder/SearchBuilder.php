<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 10:41 AM
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Support\Facades\DB;
use SethPhat\Search3\Library\Exception\BuilderException;
use SethPhat\Search3\Model\Eloquents\SearchGroup;
use SethPhat\Search3\Model\Repositories\SearchGroupRepository;

class SearchBuilder
{
    /**
     * @var DB $builder
     */
    protected $builder;

    /**
     * @var array SearchData
     */
    protected $searchData;

    /**
     * @var SearchGroup $main_group
     */
    protected $main_group;

    public function __construct($main_group) {
        $group_repo = new SearchGroupRepository();
        $this->main_group = $group_repo->getByName($main_group);
        if (empty($this->main_group)) {
            throw new BuilderException("MAIN GROUP DOESN'T EXISTS");
        }

        // ok build query builder
        $this->builder = DB::table($this->main_group->table_name);
    }

    public function setSearchData($data) {
        $this->searchData = $data;
    }
    public function getSearchData() {
        return $this->searchData ?? null;
    }
}