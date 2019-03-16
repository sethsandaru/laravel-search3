<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/1/2019
 * Time: 9:41 PM
 */

namespace SethPhat\Search3\Controller;


use Illuminate\Routing\Controller;
use Illuminate\View\View;

class BaseController extends Controller
{
    /**
     * Data package to send to view
     * @var array $data
     */
    protected $data = [
        'assets' => [
            'css' => [],
            'js' => [],
        ]
    ];

    public function __construct()
    {
        if (config('search3.use_middleware')) {
            // enable middleware
            $this->middleware(config('search3.middleware'));
        }
    }

    /**
     * @param $view
     * @return View
     */
    protected function view($view, $prefix = 'search3') {
        $this->data['prefix'] = $prefix;
        return view($prefix . "::" . $view, $this->data);
    }

    /**
     * Add js into the page
     * @param $path
     */
    protected function addJs($path) {
        $this->data['assets']['js'][] = $path;
    }

    /**
     * Add css into the page
     * @param $path
     */
    protected function addCss($path) {
        $this->data['assets']['css'][] = $path;
    }

    /**
     * Set navbar title
     * @param string $title
     */
    protected function setNavTitle($title = "") {
        $this->data['nav_title'] = $title;
    }

    protected function returnJson($data) {
        return response()->json($data);
    }

    protected function returnSuccess($data) {
        return $this->returnJson([
            'code' => 200,
            'message' => $data
        ]);
    }

    protected function returnError($data) {
        return $this->returnJson([
            'code' => 400,
            'message' => $data
        ]);
    }
}