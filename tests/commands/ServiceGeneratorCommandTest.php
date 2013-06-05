<?php

use Bentlov\Generators\Commands\ServiceGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ServiceGeneratorCommandTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->gen = m::mock('Bentlov\Generators\Generators\ServiceGenerator');
    }
    public function tearDown()
    {
        m::close();
    }

    public function testGeneratesServiceSuccessfully()
    {
        $this->gen->shouldReceive('make')
            ->once()
            ->with('app/services/Foo.php')
            ->andReturn(true);

        $command = new ServiceGeneratorCommand($this->gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals("Created app/services/Foo.php\n",
         $tester->getDisplay()
        );
    }

    public function testAlertUserIfServiceGenerationFails()
    {
        $this->gen->shouldReceive('make')
        ->once()
        ->with('app/services/Foo.php')
        ->andReturn(false);

        $command = new ServiceGeneratorCommand($this->gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals("Could not create app/services/Foo.php\n",
         $tester->getDisplay()
        );

    }
}
