<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 2:20 PM
 */

namespace SethPhat\Search3\Controller\SearchRelation;


use Illuminate\Http\Request;
use SethPhat\Search3\Controller\BaseController;
use SethPhat\Search3\Model\Repositories\SearchRelationRepository;

class RelationController extends BaseController
{
    /**
     * @var SearchRelationRepository $search_relation_repo
     */
    protected $search_relation_repo;

    public function __construct()
    {
        parent::__construct();
        $this->search_relation_repo = new SearchRelationRepository();
    }

    public function index(Request $rq) {
        $this->setNavTitle(trans("search3::relation.title"));

        // pick search data
        $searchData = [
            'keyword' => $rq->get('keyword', null),
        ];

        // get list
        $this->data['listRela'] = $this->search_relation_repo->getList($searchData, true);
        $this->data['keyword'] = $searchData['keyword'];


        return $this->view('search_relation.index');
    }
}