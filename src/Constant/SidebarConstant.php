<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/3/2019
 * Time: 1:15 PM
 */

namespace SethPhat\Search3\Constant;


class SidebarConstant
{
    const ITEMS = [
        [
            'title' => 'search3::sidebar.search_group',
            'route' => 'searchGroupPage',
            'icon' => 'fa-table',
        ],
        [
            'title' => 'search3::sidebar.search_relation',
            'route' => 'searchRelationPage',
            'icon' => 'fa-sitemap',
        ],
        [
            'title' => 'search3::sidebar.search_config',
            'route' => 'searchConfigPage',
            'icon' => 'fa-cogs',
        ],
    ];
}