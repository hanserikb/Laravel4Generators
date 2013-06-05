<?php

use Bentlov\Generators\Commands\ServiceGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ServiceGeneratorCommandTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGeneratesServiceSuccessfully()
    {
        $gen = m::mock('Bentlov\Generators\Generators\ServiceGenerator');
        $gen->shouldReceive('make')
            ->once()
            ->with('app/services/Foo.php')
            ->andReturn(true);

        $command = new ServiceGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals("Created app/services/Foo.php\n",
         $tester->getDisplay()
        );
    }
}
