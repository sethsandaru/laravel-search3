<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 2/28/2019
 * Time: 9:19 PM
 */

return [
    /**
     * Libraries/Dependencies config
     */
    'ui_library' => 'bootstrap3', // bootstrap3 or bootstrap4 or leave it blank
    'include_jquery' => true, // true if you don't have jquery yet, false if you already import it.
    'include_jquery_ui' => true, // true if you don't have jquery ui yet.


    /*
     * Important config - Middleware to protect the page
     * Normally, all routes of Search3 can be accessed by anywhere, anyone.
     * So to prevent that, you can set both of these config here to enable the middleware. Hehe.
     */
    'use_middleware' => false, // enable it (true) if you want to use middleware
    'middleware' => 'auth', // can be an array of middlewares (['auth','adminOnly',...']) or a single string. Please don't use Closure, it might get an error when caching...

    /*
     * Max Join Level, for example:
     * SELECT * FROM x
     * JOIN y ON x.y = y.y // level 1
     * JOIN u ON y.u = u.u // level 2
     * ... and so on
     */
    'max_join_level' => 3,
];