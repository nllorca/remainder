<?php

namespace Remainder\DataStream\Output\Contracts;

interface OutputInterface
{
    public function sendOutputData(array $data): void;
    public function sendOutputError(string $message): void;
}
