<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/1/2019
 * Time: 9:38 PM
 */

namespace SethPhat\Search3\Controller\SearchGroup;

use Illuminate\Http\Request;
use SethPhat\Search3\Controller\BaseController;
use SethPhat\Search3\Model\Repositories\SearchGroupRepository;

class SearchGroupController extends BaseController
{
    /**
     * @var SearchGroupRepository $group_repo
     */
    protected $group_repo;

    public function __construct()
    {
        parent::__construct();
        $this->group_repo = new SearchGroupRepository();
    }

    public function index(Request $rq) {
        // pick search data
        $searchData = [
            'keyword' => $rq->get('keyword', null),
        ];

        // get list
        $this->data['listGroup'] = $this->group_repo->getList($searchData, true);
        $this->setNavTitle(trans('search3::group.title'));
        $this->data['keyword'] = $searchData['keyword'];

        // send to view
        return $this->view('search_group.index');
    }
}