<?php

use Bentlov\Generators\Commands\ServiceGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;


class ServiceGeneratorCommandTest extends PHPUnit_Framework_TestCase
{
    public function testOutput()
    {
        $tester = new CommandTester(new ServiceGeneratorCommand);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals("The name argument is foo\n",
         $tester->getDisplay()
        );
    }
}
