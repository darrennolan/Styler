<?php namespace DarrenNolan\Styler\Compilers;

use scssc;
use scss_server;

class Scss extends FilesystemCompiler implements iCompiler
{

    public function serve($file_path)
    {
        $serve_from    = $this->config['serve_from'];
        $cache_at      = isset($this->config['cache_folder']) ? $this->config['cache_folder'] : false;
        $format_option = isset($this->config['format_option']) ? $this->config['format_option'] : 'scss_formatter_compressed';

        $scss = new scssc(); // Not namespaced. Curse you.
        $scss->setFormatter($format_option);

        $_GET['p'] = $this->sanitiseFilePath($file_path);

        if ($cache_at === false) {

            $server = new scss_server( $serve_from . '/', null, $scss);

        } else {

            $server = new scss_server( $serve_from . '/', $cache_at, $scss);

        }

        // scss_server doesn't appear to make sure of Content-Type or Last Modified headers, so we'll catch it and do it ourselves.
        ob_start();
        $server->serve();
        $contents = ob_get_clean();

        if (strpos($contents, '/* INPUT NOT FOUND') === 0) {

            return $this->serve404();

        } else {

            return $this->serveCss($contents);

        }

    }

}
