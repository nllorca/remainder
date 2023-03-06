<?php
namespace Remainder;

use PHPUnit\Framework\TestCase;
use Remainder\DataStream\Output\CommandLineOutput;

class CommandLineOutputTest extends TestCase
{
    public function testSendOutputData()
    {
        $expected = '1'.PHP_EOL.'2'.PHP_EOL.'3'.PHP_EOL.'4'.PHP_EOL.'5'.PHP_EOL;
        $this->expectOutputString($expected);
        $output = new CommandLineOutput();
        $output->sendOutputData([1,2,3,4,5]);
    }

    public function testSendOutputError()
    {
        $expected = 'ERROR: Test error'.PHP_EOL;
        $this->expectOutputString($expected);
        $output = new CommandLineOutput();
        $output->sendOutputError('Test error');
    }
}