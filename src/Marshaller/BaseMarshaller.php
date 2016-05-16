<?php

namespace Vynyl\Xenolith\Marshaller;

use Illuminate\Filesystem\Filesystem;
use Twig_Environment;

abstract class BaseMarshaller
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The twig instance.
     *
     * @var \Twig_Environment
     */
    protected $twig;


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
     * Empty method that will eventually be for post hooks
     */
    protected function firePostCreationHooks()
    {

    }
}
