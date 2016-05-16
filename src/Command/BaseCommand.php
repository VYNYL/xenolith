<?php

namespace Vynyl\Xenolith\Commands;

use Illuminate\Console\Command;


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
     * @var Twig instance
     */
    public $twig;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];

        // TODO: load this as a service
        $loader = new Twig_Loader_Filesystem(__DIR__ .'/../../templates');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => storage_path('/twig/cache'),
        ));
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
