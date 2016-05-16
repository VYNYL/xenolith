<?php

namespace Vynyl\Xenolith\Marshaller;

use Illuminate\Filesystem\Filesystem;
use Twig_Environment;

class ModelMarshaller extends BaseMarshaller
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * BaseMarshaller constructor.
     * @param  \Illuminate\Filesystem\Filesystem  $files
     */
    public function __construct(FileSystem $files,
                                Twig_Environment $twig)
    {
        $this->files    = $files;
        $this->twig     = $twig;
    }

    /**
     * Create a new model at the given path.
     *
     * @param  string  $name
     * @param  string  $path
     * @param  string  $table
     * @param  bool    $create
     * @return string
     */
    public function create($name, $path, $data)
    {
        $path = $this->getPath($name, $path);

        // First we will get the stub file for the migration, which serves as a type
        // of template for the migration. Once we have those we will populate the
        // various place-holders, save the file, and run the post create event.
        $template = $this->getTemplate($name);

        $modelFile = $this->twig->render($template, $data);

        $this->files->put($path, $modelFile);

        // $this->firePostCreateHooks();

        return $path;
    }
}
