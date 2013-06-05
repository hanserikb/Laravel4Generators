<?php namespace Bentlov\Generators\Commands;

use Bentlov\Generators\Generators\ServiceGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ServiceGeneratorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'generate:service';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a new service layer class';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(ServiceGenerator $generator)
	{
		parent::__construct();
        $this->generator = $generator;

	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
        $path = $this->getPath();
        if ($this->generator->make($path)) {
            $this->info("Created {$path}");
        } else {
            $this->info("Could not create {$path}");
        }
    }

    protected function getPath()
    {
        return $this->option('path') . '/' . ucwords($this->argument('name')) . '.php';
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'Name of the model.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('path', null, InputOption::VALUE_OPTIONAL, 'Path to the services directory.', 'app/services'),
		);
	}

}
