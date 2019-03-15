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
 * Class SearchGroup
 * @package SethPhat\Search3\Model\Eloquents
 * @property integer $id
 * @property string $name
 * @property string $table_name
 * @property string $meta_data
 * @property SearchGroupField[] $Fields
 * @property array MetaDataObject
 */
class SearchGroup extends Model
{
    protected $table = "search_group";
    protected $primaryKey = "id";
    public $timestamps = true;
    public static $snakeAttributes = false;
    protected $fillable = [
        'name', 'table_name', 'meta_data'
    ];

    public function Fields() {
        return $this->hasMany(SearchGroupField::class, "group_id");
    }

    public function getMetaDataObjectAttribute() {
        return json_decode($this->meta_data, true);
    }
}