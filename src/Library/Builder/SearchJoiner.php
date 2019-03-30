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

    /**
     * The joinning process.
     * Conditions is a JSON Array, look like this:
     * [
     *      {
     *          first: "Column",
     *          operator: ">", // > < != = ,...
     *          second: "Column"
     *      },
     *      {
     *          type: "AND|OR", // only got this for the second one.
     *          ...
     *      }
     * ]
     */
    private function joining() {
        // retrieve all the join table
        $tables = $this->relation_repo->getJoinTable($this->main_group->id);
        $this->tables = $tables;

        foreach($tables as $table) {
            $table_join = $table['table']->table_name . " AS " . $table['table']->name;

            // prepare the condition
            $conditionObj = json_decode($table['condition']);
            if (empty($conditionObj) || !is_array($conditionObj)) {
                throw new \Exception("COULDN'T PROCESS THE JOIN OF {$table['table']->name} BECAUSE OF EMPTY CONDITION OR WRONG FORMAT");
            }
            $join_condition_func = function($query) use ($conditionObj) {
                foreach ($conditionObj as $conditional) {
                    if (isset($conditional->type) && $conditional->type == "OR") {
                        // ON ... OR ...
                        $query->orOn($conditional->first, $conditional->operator, $conditional->second);
                    } else {
                        // ON .. AND ...
                        $query->on($conditional->first, $conditional->operator, $conditional->second);
                    }
                }
            };

            // start to join
            switch ($table['type']) {
                case RelationConstant::LEFT_JOIN:
                    $this->builder->leftJoin($table_join, $join_condition_func);
                    break;
                case RelationConstant::RIGHT_JOIN:
                    $this->builder->rightJoin($table_join, $join_condition_func);
                    break;
                case RelationConstant::INNER_JOIN:
                default:
                    $this->builder->join($table_join, $join_condition_func);
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