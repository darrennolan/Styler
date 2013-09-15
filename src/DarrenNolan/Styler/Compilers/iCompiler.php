<?php namespace DarrenNolan\Styler\Compilers;

interface iCompiler
{
    public function __construct(Array $config);

    public function serve($file_path);
}
