<?php

namespace Vynyl\Xenolith\Command;

use Illuminate\Console\Command;
use Vynyl\Xenolith\Marshaller\BaseMarshaller;

abstract class BaseCommand extends Command
{
    /**
     * The command data.
     *
     * @var CommandData
     */
    public $commandData;

    /**
     * @var Composer instance
     */
    public $composer;

    /**
     * @var BaseMarshaller instance
     */
    public $marshaller;

    /**
     * Create a new command instance.
     */
    public function __construct(BaseMarshaller $marshaller)
    {
        parent::__construct();

        $this->composer = app()['composer'];

        $this->marshaller = $marshaller;

    }

    public function handle()
    {
        $this->commandData->modelName = $this->argument('model');
    }

    public function performPostActions($runMigration = false)
    {

        if ($runMigration) {
            if ($this->commandData->config->forceMigrate) {
                $this->call('migrate');
            } elseif ($this->confirm("\nDo you want to migrate database? [y|N]", false)) {
                $this->call('migrate');
            }
        }
        if (!$this->commandData->getOption('skipDumpOptimized')) {
            $this->info('Generating autoload files');
            $this->composer->dumpOptimized();
        }
    }

    public function performPostActionsWithMigration()
    {
        $this->performPostActions(true);
    }

    abstract protected function getTemplate();

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['tableName', null, InputOption::VALUE_REQUIRED, 'Table Name'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'Singular Model name'],
        ];
    }
}
