<?php

namespace Remainder\DataStream\Output;

use Remainder\DataStream\Output\Contracts\OutputInterface;

class CommandLineOutput implements OutputInterface
{
    public function sendOutputData(array $data): void
    {
        foreach ($data as $value) {
            echo $value . PHP_EOL;
        }
    }

    public function sendOutputError(string $message): void
    {
        echo 'ERROR: ' . $message . PHP_EOL;
    }
}
