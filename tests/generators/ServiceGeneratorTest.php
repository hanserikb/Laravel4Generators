<?php
use Bentlov\Generators\Generators\ServiceGenerator;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;


class ServiceGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->file = m::mock('Illuminate\Filesystem\Filesystem[put]');
    }

    public function tearDown()
    {
        m::close();
    }

    public function testCanGenerateServiceUsingTemplate()
    {
        $this->file->shouldReceive('put')
            ->once()
            ->with('app/services/Foo.php', file_get_contents(__DIR__ . '/stubs/service.txt'));

        $generator = new ServiceGenerator($this->file);

        $generator->make('app/services/Foo.php');
    }
}
