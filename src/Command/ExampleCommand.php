<?php

namespace Vynyl\Xenolith\Command;

class ExampleCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'vynyl:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Example creation command.';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->marshaller->create($this->getTemplate(), './', ['namespace' => 'Slartiblartfast']);
    }

    protected function getTemplate()
    {
        return 'example.twig';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
}
