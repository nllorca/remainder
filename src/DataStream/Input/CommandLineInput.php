<?php

namespace Remainder\DataStream\Input;

use Remainder\DataStream\ValueObject\Parameters;
use Remainder\DataStream\Input\Contracts\InputInterface;
use Remainder\DataStream\Input\Exceptions\InvalidInputException;

class CommandLineInput implements InputInterface
{
    private const MIN_NUMBER_OF_CASES = 1;
    private const MAX_NUMBER_OF_CASES = 5 * 10 ** 4;
    private const INVALID_NUMBER_OF_CASES_MESSAGE = 'First input line invalid. Must be %min <= t <= %max';
    private const INVALID_DATA_LINE_MESSAGE = 'Invalid line of data. Must be X Y N';
    private string $inputFile;

    public function __construct()
    {
        $this->inputFile ='php://stdin';
    }

    public function setInputFile(string $inputFile): void
    {
        $this->inputFile = $inputFile;
    }

    public function getInputData(): array
    {
        $stdin = fopen($this->inputFile, 'r');

        $data = [];

        fscanf($stdin, "%d\n", $numberOfCases);   

        if (is_null($numberOfCases) || $numberOfCases < self::MIN_NUMBER_OF_CASES || $numberOfCases > self::MAX_NUMBER_OF_CASES) {
            throw new InvalidInputException(strtr(
                self::INVALID_NUMBER_OF_CASES_MESSAGE,
                [
                    '%min' => self::MIN_NUMBER_OF_CASES,
                    '%max' => self::MAX_NUMBER_OF_CASES,
                ]
            ));
        }

        for ($i = 0; $i < $numberOfCases; $i++) {
            fscanf($stdin, "%d %d %d\n", $x, $y, $n);

            if (is_null($x) || is_null($y) || is_null($n)) {
                throw new InvalidInputException(self::INVALID_DATA_LINE_MESSAGE);
            }

            $data[] = new Parameters($x, $y, $n);
        }

        return $data;
    }
}