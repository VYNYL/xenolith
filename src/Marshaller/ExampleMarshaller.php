<?php

namespace Vynyl\Xenolith\Marshaller;

use Illuminate\Filesystem\Filesystem;
use Twig_Environment;

class ExampleMarshaller extends BaseMarshaller
{
    /**
     * BaseMarshaller constructor.
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Twig_Environment  $files
     */
    public function __construct(FileSystem $files,
                                Twig_Environment $twig)
    {
        parent::__construct($files, $twig);
    }

    /**
     * Create a new example file at the given path.
     *
     * @param  string  $name
     * @param  string  $path
     * @param  array   $data
     * @return string
     */
    public function create($name, $path, $data)
    {
        $path = $path . $name;

        $template = $name;//$this->getTemplate($name);

        $modelFile = $this->twig->render($template, $data);

        echo $path;
        $this->files->put($path, $modelFile);

        $this->firePostCreationHooks();

        return $path;
    }
}
