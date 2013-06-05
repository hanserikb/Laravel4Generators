<?php
namespace Bentlov\Generators\Generators;

use Illuminate\Filesystem\Filesystem as File;
/**
* .
*/
class ServiceGenerator {

    function __construct(File $file)
    {
        $this->file = $file;
    }
    public function make($path)
    {
        $name = basename($path, '.php');

        $template = $this->getTemplate($name);

        if (! $this->file->exists($path)) {
            if (! $this->file->isDirectory($path)) {
                {
                    $this->file->makeDirectory(dirname($path), 511, true);
                }
            }
            return $this->file->put($path, $template);
        }

        return false;
    }

    protected function getTemplate($name)
    {
        $template = $this->file->get(__DIR__ . '/templates/service.txt');

        return str_replace('{{name}}', $name, $template);
    }
}
