<?php
namespace Remainder;

use Remainder\RemainderSolver\SimpleSolver;
use Remainder\DataStream\Input\CommandLineInput;
use Remainder\DataStream\Output\CommandLineOutput;

require __DIR__ . '/vendor/autoload.php';

use Remainder\App;

$app = new App();
$app->run();

/** Optional: Can run the app with non-default input, output and solver */
/* 
$app
    ->setInput(new CommandLineInput())
    ->setOutput(new CommandLineOutput())
    ->setSolver(new SimpleSolver())
    ->run();
*/