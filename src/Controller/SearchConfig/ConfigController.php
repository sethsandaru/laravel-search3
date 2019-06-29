<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 6/29/2019
 * Time: 11:28 AM
 */

namespace SethPhat\Search3\Controller\SearchConfig;


use Illuminate\Http\Request;
use SethPhat\Search3\Controller\BaseController;
use SethPhat\Search3\Model\Eloquents\SearchGroup;
use SethPhat\Search3\Model\Repositories\SearchTemplateRepository;

class ConfigController extends BaseController
{
    /**
     * @var SearchTemplateRepository $template_repo
     */
    protected $template_repo;

    public function __construct()
    {
        parent::__construct();
        $this->template_repo = new SearchTemplateRepository();
    }

    public function index(Request $rq) {
        // pick search data
        $searchData = [
            'keyword' => $rq->get('keyword', null),
        ];

        // get list
        $this->data['listGroup'] = $this->template_repo->getList($searchData, true);
        $this->setNavTitle(trans('search3::template.title'));
        $this->data['keyword'] = $searchData['keyword'];

        // send to view
        return $this->view('search_config.index');
    }

    public function config($search_group_id) {
        $search_group = SearchGroup::find($search_group_id);
        if (empty($search_group)) {
            return redirect()->route('searchConfigPage');
        }

        // version and is add...
        $this->data['is_add'] = true;
        $this->data['version'] = __("search3::base.none");

        // get last template and check it
        $last_template = $search_group->Templates->last();
        if (!empty($last_template)) {
            $this->data['is_add'] = false;
            $this->data['version'] = $last_template->version;
        }

        // set data
        $this->data['group'] = $search_group;
        $this->data['latest_template'] = $last_template;
        $this->setNavTitle(__('search3::template.config_title', ['name' => $search_group->name]));

        return $this->view('search_config.config');
    }
}