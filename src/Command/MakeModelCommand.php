<?php

namespace Vynyl\Xenolith\Command;

class MakeModelCommand extends BaseCommand
{

    protected function getTemplate()
    {
        return __DIR__ . '/../templates/model.twig';
    }
}
