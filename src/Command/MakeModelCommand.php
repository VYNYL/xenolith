<?php

namespace Vynyl\Xenolith\Commands;

class MakeModelCommand extends BaseCommand
{

    protected function getTemplate()
    {
        return __DIR__ . '/../templates/model.twig';
    }
}
