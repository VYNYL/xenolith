<?php

namespace Vynyl\Xenolith\Value;

abstract class Template
{
    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Formats the docs before they are applied to the template.
     * @param $docs string
     * @return string
     */
    public function formatDocs($docs)
    {
        return $this->docs;
    }

}
