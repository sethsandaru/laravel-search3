<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 9:21 PM
 */

namespace SethPhat\Search3\Model\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use SethPhat\Search3\Constant\RelationConstant;

/**
 * Class SearchRelation
 * @package SethPhat\Search3\Model\Eloquents
 * @property integer $base_group_id
 * @property integer $join_group_id
 * @property integer $type
 * @property string $condition
 * @property string $FinalCondition
 * @property SearchGroup $BaseJoinTable
 * @property SearchGroup $JoinedTable
 */
class SearchRelation extends Model
{
    protected $table = "search_relation";
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;
    public static $snakeAttributes = false;
    protected $fillable = [
        'base_group_id', 'join_group_id', 'type', 'condition'
    ];

    // relationship
    public function BaseJoinTable() {
        return $this->belongsTo(SearchGroup::class, "base_group_id");
    }

    public function JoinedTable() {
        return $this->belongsTo(SearchGroup::class, "join_group_id");
    }
}