<?php namespace DarrenNolan\Styler\Compilers;

use lessc;
use Illuminate\Support\Facades\Response;

class Less extends FilesystemCompiler implements iCompiler
{

    public function serve($file_path)
    {
        $file_path     = $this->config['serve_from'] . '/' . $this->sanitiseFilePath($file_path);

        $cache_at      = isset($this->config['cache_folder']) ? $this->config['cache_folder'] : false;
        $format_option = isset($this->config['format_option']) ? $this->config['format_option'] : 'compressed';

        if (!file_exists($file_path)) {
            return $this->serve404();
        }

        // Taken from https://gist.github.com/lavoiesl/4127137/raw/5c7171e37890fc7db514e8d665d736195bca0e63/less.php
        // and slightly modified. Will review/refactor at a later date if/when required.
        $less = new lessc;
        $less->setFormatter($format_option);

        if ($cache_at === false) {

            $contents = $less->compileFile($file_path);

        } else {

            $cache_file = $cache_at . '/' . md5($file_path) . '.less';

            try {

                $less->checkedCompile($file_path, $cache_file);

                $contents = file_get_contents($cache_file);

            } catch (Exception $e) {

                return $this->serve500($e->getMessage());

            }


        }

        // Insert some fancy 'not modified' cache here.

        return $this->serveCss($contents);
    }

    protected function serve500($message)
    {
        $contents = '/* Styler Less Internal Server Error */' . "\n";
        $contents .= '/*' . $message . '*/';

        $response = Response::make($contents, 500);
        $response->headers->set('Content-Type', 'text/css');

        return $response;
    }

}
