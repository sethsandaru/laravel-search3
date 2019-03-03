<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 9:21 PM
 */

namespace SethPhat\Search3\Model\Eloquents;


use Illuminate\Database\Eloquent\Model;

/**
 * Class SearchGroupField
 * @package SethPhat\Search3\Model\Eloquents
 * @property integer $id
 * @property integer $group_id
 * @property integer $type
 * @property string $field_name
 * @property string $meta_data - JSON string
 */
class SearchGroupField extends Model
{
    protected $table = "search_group_field";
    protected $primaryKey = "id";
    public $timestamps = true;
    public static $snakeAttributes = false;
    protected $fillable = [
        'group_id', 'field_name', 'type', 'meta_data'
    ];

}