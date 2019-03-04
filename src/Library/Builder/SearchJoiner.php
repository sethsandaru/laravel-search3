<?php
/**
 * Created by PhpStorm.
 * User: phattran
 * Date: 2019-03-04
 * Time: 17:05
 */

namespace SethPhat\Search3\Library\Builder;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use SethPhat\Search3\Constant\RelationConstant;
use SethPhat\Search3\Model\Eloquents\SearchGroup;
use SethPhat\Search3\Model\Repositories\SearchRelationRepository;

class SearchJoiner
{
    /**
     * @var SearchGroup $main_group
     */
    protected $main_group;

    /**
     * @var Builder $builder
     */
    protected $builder;

    protected $tables = [];
    /**
     * @var SearchRelationRepository $relation_repo
     */
    protected $relation_repo;

    public function __construct(SearchGroup $main_group, Builder $builder) {
        $this->main_group = $main_group;
        $this->builder = $builder;
        $this->relation_repo = new SearchRelationRepository();

        // run the process
        $this->joining();
    }

    private function joining() {
        // retrieve all the join table
        $tables = $this->relation_repo->getJoinTable($this->main_group->id);
        $this->tables = $tables;

        foreach($tables as $table) {
            switch ($table['type']) {
                case RelationConstant::LEFT_JOIN:
                    $this->builder->leftJoin($table['table']->name, DB::raw($table['table']->condition));
                    break;
                case RelationConstant::RIGHT_JOIN:
                    $this->builder->rightJoin($table['table']->name, DB::raw($table['table']->condition));
                    break;
                case RelationConstant::INNER_JOIN:
                default:
                    $this->builder->join($table['table']->name, DB::raw($table['table']->condition));
            }
        }
    }

    /**
     * @return array
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * @param array $tables
     */
    public function setTables(array $tables): void
    {
        $this->tables = $tables;
    }
}