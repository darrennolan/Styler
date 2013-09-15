<?php namespace DarrenNolan\Styler\Compilers;

class Css extends FilesystemCompiler implements iCompiler
{

    public function serve($file_path)
    {
        $file_path = $this->config['serve_from'] . '/' . $this->sanitiseFilePath($file_path);

        if (file_exists($file_path)) {

            return $this->serveCss(file_get_contents($file_path));

        } else {

            return $this->serve404();

        }

    }

}
