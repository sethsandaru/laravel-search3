<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 9:21 PM
 */

namespace SethPhat\Search3\Model\Eloquents;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Search3
 * @package SethPhat\Search3\Model\Eloquents
 * @property integer $id
 * @property integer $search3_id - indexed
 * @property integer $version
 * @property string $search_form - JSON string
 * @property string $table_result - JSON string
 */
class Search3Template extends Model
{
    use SoftDeletes;

    protected $table = "search3_template";
    protected $primaryKey = "id";
    public $timestamps = true;
    public static $snakeAttributes = false;
}