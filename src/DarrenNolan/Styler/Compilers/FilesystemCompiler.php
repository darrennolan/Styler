<?php namespace DarrenNolan\Styler\Compilers;

use Illuminate\Http\Response;

abstract class FilesystemCompiler
{
    protected $config;

    public function __construct(Array $config)
    {
        $this->config = $config;
    }

    protected function sanitiseFilePath($file_path)
    {
        return $this->resolveFilename($file_path);
    }

    protected function serveCss($contents, Array $additional_headers = null)
    {
        $response = new Response($contents, 200);
        $response->headers->set('Content-Type', 'text/css');

        if (is_array($additional_headers)) {

            foreach ($additional_headers as $header_type => $header_content) {

                $response->headers->set($header_type, $header_content);

            }

        }

        return $response;
    }

    protected function serve404()
    {
        $contents = '/* Styler Source File Not Found */';

        $response = new Response($contents, 404);
        $response->headers->set('Content-Type', 'text/css');

        return $response;
    }

    /**
     * realpath() replacement (as it's not an awesome function)
     * http://tomnomnom.com/posts/realish-paths-without-realpath
     * @param  string $filename Path to File
     * @return string           Location calculated without ../ parts
     */
    protected function resolveFilename($filename)
    {
        $filename = str_replace('//', '/', $filename);
        $parts    = explode('/', $filename);
        $out      = array();

        foreach ($parts as $part){
            if ($part == '.') continue;

            if ($part == '..') {

                array_pop($out);
                continue;

            }

            $out[] = $part;

        }

        return implode('/', $out);
    }

}
