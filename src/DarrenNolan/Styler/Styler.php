<?php namespace DarrenNolan\Styler;

use DarrenNolan\Styler\Compilers\iCompiler;

class Styler {
    protected $compiler;

    public function __construct(iCompiler $compiler = null)
    {
        if ($compiler !== null) {

            $this->useCompiler($compiler);

        }
    }

    public function useCompiler(iCompiler $compiler)
    {
        $this->compiler = $compiler;
    }

    public function serve($file_path)
    {
        return $this->compiler->serve($file_path);
    }

}
