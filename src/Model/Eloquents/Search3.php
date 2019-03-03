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
 * @property string $name
 */
class Search3 extends Model
{
    use SoftDeletes;

    protected $table = "search3";
    protected $primaryKey = "id";
    public $timestamps = true;
    public static $snakeAttributes = false;
}