<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 8:34 PM
 */

$route_prefix = "search3";

Route::get($route_prefix, function() {
    return redirect()->route('searchGroupAddPage');
});

Route::prefix("$route_prefix/search_group")->namespace("\SethPhat\Search3\Controller\SearchGroup")->group(function () {
    Route::get("/", "SearchGroupController@index")->name("searchGroupPage");

    // add group
    Route::get("/add", "SearchGroupController@add")->name("searchGroupAddPage");
    Route::post("/add", "SearchGroupController@saveAdd");

    // edit group
    Route::get("/edit/{id}", "SearchGroupController@edit")->name('searchGroupEditPage')->where('id', '[0-9]+');
    Route::post("/edit/{id}", "SearchGroupController@saveEdit")->where('id', '[0-9]+');


    // delete group
    Route::post("/delete/{id}", "SearchGroupController@delete")->where('id', '[0-9]+');

});

Route::prefix("$route_prefix/search_relation")->namespace("\SethPhat\Search3\Controller\SearchRelation")->group(function () {
    Route::get("/", "RelationController@index")->name("searchRelationPage");

});

Route::prefix("$route_prefix/search_config")->namespace("\SethPhat\Search3\Controller\SearchConfig")->group(function () {
    Route::get("/", "ConfigController@index")->name("searchConfigPage");

});