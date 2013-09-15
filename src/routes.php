<?php
/**
 * SCSS Compiler (on everything under /app/scss/*)
 */
Route::group(array('prefix' => Config::get('styler::base_route')), function () {

    Route::get('{file_path?}', function($file_path)
    {

        $response = Styler::serve($file_path);

        if ($response === true) {

            // If the response comes back as true true,
            // expecting the Styler to have delivered to browser already
            return;

        } else {

            return $response;

        }

    })->where('file_path', '.*');

});
