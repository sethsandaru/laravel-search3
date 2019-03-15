<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 10:41 AM
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use SethPhat\Search3\Library\Exception\BuilderException;
use SethPhat\Search3\Library\Hooks\BaseHook;
use SethPhat\Search3\Model\Eloquents\SearchGroup;
use SethPhat\Search3\Model\Repositories\SearchGroupRepository;

class SearchBuilder
{
    /**
     * @var Builder $builder
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

    /**
     * @var SearchGroupRepository $search_group_repo
     */
    protected $search_group_repo;

    /**
     * @var BaseHook $hook_obj
     */
    protected $hook_obj;

    public function __construct($main_group) {
        $this->search_group_repo = new SearchGroupRepository();
        $this->main_group = $this->search_group_repo->getByName($main_group);
        if (empty($this->main_group)) {
            throw new BuilderException("MAIN GROUP DOESN'T EXISTS");
        }

        // ok build query builder
        $this->builder = DB::table($this->main_group->table_name);
    }

    public function setSearchData(array $data) {
        $this->searchData = $data;
    }
    public function getSearchData() {
        return $this->searchData ?? null;
    }

    /**
     * @return BaseHook
     */
    public function getHookObj(): BaseHook
    {
        return $this->hook_obj;
    }

    /**
     * @param BaseHook $hook_obj
     */
    public function setHookObj(BaseHook $hook_obj): void
    {
        $this->hook_obj = $hook_obj;
    }

    /**
     * @throws BuilderException
     */
    public function build() {
        if (!isset($this->searchData)) {
            throw new BuilderException("SEARCH DATA IS EMPTY");
        }

        // run hooks
        $this->hook_obj->beforeBuildQuery($this->searchData);

        // get config data - joins
        $joiner = new SearchJoiner($this->main_group, $this->builder);

        // get config data - fields
        $fielder = new SearchFielder($this->main_group, $joiner->getTables(), $this->builder);

        // paging
        $pager = new SearchPaging($this->searchData, $this->builder);

        // ordering
        $orderer = new SearchOrder($this->searchData, $this->builder);

        // condition
        $conditioner = new SearchCondition($this->searchData, $this->builder);

        // ready to query
        $this->hook_obj->afterBuiltQuery($this->builder, $this->searchData);

        // query
        $sql = $this->builder->toSql();
    }
}