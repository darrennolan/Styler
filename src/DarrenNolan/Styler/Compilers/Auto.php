<?php namespace DarrenNolan\Styler\Compilers;

class Auto implements iCompiler
{
    protected $config;

    public function __construct(Array $config)
    {
        $this->config = $config;
    }

    public function serve($file_path)
    {
        return $this->getCompilerFromFile($file_path)->serve($file_path);
    }

    protected function getCompilerFromFile($file_path)
    {
        $path_info = pathinfo($file_path);

        switch ($path_info['extension']) {
            case 'less':
                return new Less($this->config);

            case 'scss':
                return new Scss($this->config);

            case 'css':
            default:
                return new Css($this->config);
        }
    }

}
