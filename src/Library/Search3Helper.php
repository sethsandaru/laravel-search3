<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 9:00 PM
 */

namespace SethPhat\Search3\Library;


use Illuminate\Support\Facades\View;

class Search3Helper
{
    /**
     * Render the base form & table
     * @return string
     */
    public static function render() {
        return View::make('search3::base.search_form');
    }

    /**
     * Inject Css
     * @return string
     */
    public static function assetCss() {
        $css = [
//            'vendor/search3/css/jquery.dataTables.min.css',
            'vendor/search3/css/select.dataTables.min.css',
            'vendor/search3/css/select2.min.css',
            'vendor/search3/css/select2-bootstrap.min.css',
        ];

        if (config('search3.include_jquery_ui')) {
            $css[] = 'vendor/search3/css/jquery-ui.min.css';
        }

        switch (config('search3.ui_library')) {
            case 'bootstrap3':
                $css[] = "vendor/search3/css/dataTables.bootstrap.min.css";
                $css[] = "vendor/search3/css/select.bootstrap.min.css";
                break;
            case 'bootstrap4':
                $css[] = "vendor/search3/css/dataTables.bootstrap4.min.css";
                $css[] = "vendor/search3/css/select.bootstrap4.min.css";
                break;
        }

        return View::make('search3::base.import_css', ['css' => $css]);
    }

    /**
     * Inject Js
     * @return string
     */
    public static function assetJs() {
        $js = [
            'vendor/search3/js/jquery.dataTables.min.js',
            'vendor/search3/js/dataTables.select.min.js',
            'vendor/search3/js/select2.min.js',
        ];

        if (config('search3.include_jquery')) {
            array_unshift($js, 'vendor/search3/js/jquery-3.3.1.min.js');
        }

        if (config('search3.include_jquery_ui')) {
            $js[] = 'vendor/search3/js/jquery-ui.min.js';
        }

        switch (config('search3.ui_library')) {
            case 'bootstrap3':
                $js[] = "vendor/search3/js/dataTables.bootstrap.min.js";
                $js[] = "vendor/search3/js/select.bootstrap.min.js";
                break;
            case 'bootstrap4':
                $js[] = "vendor/search3/js/dataTables.bootstrap4.min.js";
                $js[] = "vendor/search3/js/select.bootstrap4.min.js";
                break;
        }

        return View::make('search3::base.import_js', ['js' => $js]);
    }
}