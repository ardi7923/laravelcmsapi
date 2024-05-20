<?php

namespace Ardi7923\Laravelcmsapi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Ardi7923\Laravelcmsapi\Utilities\CommandUtility;
use Ardi7923\Laravelcmsapi\Console\Commands\CreateCrudApiControllerFile;
use File;

class CrudApi extends Command
{
    use CommandUtility;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelcmsapi:crudApi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Simple Crud Api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files, CreateCrudApiControllerFile $create_controller)
    {
        $this->files = $files;
        $this->path = app_path();
        $this->create_controller = $create_controller;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Crud Api Started......");
        sleep(1);

        $modelName = $this->ask('Whats Model name ?');
        $modelDir  = "$this->path/Models/$modelName.php";

        /**
         * check file model
         * if model not found return Fail
         */
        if (!$this->files->isFile($modelDir)) {
            return $this->error('Model Not Found');
        }

        $this->info("Model Found");
        $this->info(str_repeat(".", 25));
        sleep(1);

        // input controller name

        $inputControllerName = $this->ask('Controller name ? (ex: Admin/TesController or TesController)');

        /**
         * check Controller Name
         * FAIL if controller name null or empty
         */
        if ($inputControllerName == '' || $inputControllerName == null) {
            return $this->error('Controller Name Required');
        }

        $requestName = '';
        $choiceRequest = $this->choice(
            'Did you create Request?',
            ['No', 'Yes'],
            'Yes',
            null,
            false
        );

        if ($choiceRequest === 'Yes') {
            $requestName = $this->ask('Request name ?');
        }

        $resourceName = '';
        $choiceResource = $this->choice(
            'Did you create Resource?',
            ['No', 'Yes'],
            'Yes',
            null,
            false
        );

        if ($choiceResource === 'Yes') {
            $resourceName = $this->ask('Resource name ?');
        }

        // compile Request
        if ($choiceRequest === 'Yes') {
            $this->call('make:request', [
                'name' => $requestName
            ]);
        }

        // compile Request
        if ($choiceResource === 'Yes') {
            $this->call('make:resource', [
                'name' => $resourceName
            ]);
        }

        // compile Controller
        $this->create_controller
            ->setModel($modelName)
            ->setName($inputControllerName)
            ->setResource(($choiceResource === "Yes") ? $resourceName : '')
            ->setRequest(($choiceRequest === "Yes") ? $requestName : '')
            ->create();
//        $this->info($tes);
        $this->info('Controller Compiled !!');


        $this->info(str_repeat('-',25));
        $this->info('Crud Api Genenerated');
    }
}
