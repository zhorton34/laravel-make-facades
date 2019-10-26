<?php

namespace CleanCodeStudio\MakeFacades\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class FacadeMakeGenerator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:facade';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new facade, with its related class';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'facades';

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $saveTo = config('make-facades.path');
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path = Str::replaceLast('app', $saveTo, $this->laravel['path']);
        $path = $path.str_replace('\\', '/', $name).'/'.$this->getNameInput().'.php';
        
        return Str::replaceFirst('Facades', 'facades', $path);
    }

    /**
     * @return array
     */
    protected function getStub()
    {
        return [
            __DIR__.'/../stubs/DummyService.stub',
            __DIR__.'/../stubs/DummyServiceFacade.stub',
        ];
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return config('make-facades.namespace');
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->qualifyClass($this->getNameInput());
        $facadeName = $this->qualifyClass("{$this->getNameInput()}Facade");

        $path = $this->getPath($name);
        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((! $this->hasOption('force') ||
                ! $this->option('force')) &&
            $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $serviceStub = $this->files->get(__DIR__.'/../stubs/DummyService.stub');
        $serviceClass = $this->replaceNamespace($serviceStub, $name)->replaceClass($serviceStub, $name);

        $facadeStub = $this->files->get(__DIR__.'/../stubs/DummyServiceFacade.stub');
        $facadeClass = $this->replaceNamespace($facadeStub, $facadeName)->replaceClass($facadeStub, $facadeStub);

        $this->files->put($path, $serviceClass);
        $this->info('created service successfully');

        $this->files->put(Str::replaceLast('.php', 'Facade.php', $path), $facadeClass);
        $this->info('created facade successfully');
    }


    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        return str_replace('DummyService', $this->argument('name'), $stub);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Facades';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the facade class and related service class.'],
        ];
    }
}
