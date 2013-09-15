<?php

return array(
    /**
     * Route 'directory' to listen on.
     *  Either use a Compiler name (less/scss) or auto will switch the driver based on the file extension accessed.
     *
     *  Use a full namespace class if you wish to use another driver you've written yourself.
     *  Mynamespace\\StylerDrivers\\FancyCompiler - and ensure it implements DarrenNolan\Styler\Compilers\iCompile
     */
    'base_route' => 'styler',

    /**
     * Default Compiler to use
     */
    'compiler'     => 'auto',

    /**
     * Compiler Settings
     *  serve_from - Where to find source files
     *  cache_folder - Where these compilers will store their cached compiled versions
     */
    'compilers' => array(

        'auto' => array(
            'serve_from'   => app_path()     . '/css',
            'cache_folder' => storage_path() . '/cache/styler_cache',
        ),

        'css' => array(
            'serve_from'   => app_path()     . '/css',
            'cache_folder' => false,
        ),

        'less' => array(
            'serve_from'   => app_path()     . '/css',
            'cache_folder' => storage_path() . '/cache/styler_cache',

            /**
             * See http://leafo.net/scssphp/docs/#output_formatting for options
             * Valid options are 'lessjs', 'compressed', 'classic' and null
             */
            'format_option' => 'compressed',
        ),

        'scss' => array(
            'serve_from'    => app_path()     . '/css',
            'cache_folder'  => storage_path() . '/cache/styler_cache',

            /**
             * See http://leafo.net/scssphp/docs/#output_formatting for options
             * Valid options are 'scss_formatter', 'scss_formatter_nested', and 'scss_formatter_compressed'
             */
            'format_option' => 'scss_formatter_compressed',
        ),

    ),
);
