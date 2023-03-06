<?php
namespace Remainder;

use PHPUnit\Framework\TestCase;
use Remainder\DataStream\Input\CommandLineInput;
use Remainder\DataStream\Input\Exceptions\InvalidInputException;

class CommandLineInputTest extends TestCase
{
    private function getDummyStdInFile(): string
    {
        return sys_get_temp_dir(). DIRECTORY_SEPARATOR . 'php_input.txt';
    }

    private function setDataInDummyStdIn($data)
    {
        file_put_contents($this->getDummyStdInFile(), $data);
    }

    public function testExceptionIsRaisedForInvalidNumberOfCases()
    {
        $this->expectException(InvalidInputException::class);
        $input = new CommandLineInput();
        $input->setInputFile($this->getDummyStdInFile());

        $inputText = "0\n7 5 12345\n";

        $this->setDataInDummyStdIn($inputText);

        $data = $input->getInputData();
    }

    public static function invalidDataLineProvider(): array
    {
        return [
            ["1\ninvalidString\n"],
            ["1\n12\n"],
            ["1\n12 12 invalidN\n"],
            ["1\ninvalidX invalidY invalidN\n"],
            ["1\ninvalidX 2 3\n"],
            ["1\n1 invalidY 3\n"],
        ];
    }

    /**
    * @dataProvider invalidDataLineProvider
    */
    public function testExceptionIsRaisedForInvalidDataLine($inputText)
    {
        $this->expectException(InvalidInputException::class);
        $input = new CommandLineInput();
        $input->setInputFile($this->getDummyStdInFile());

        $this->setDataInDummyStdIn($inputText);

        $data = $input->getInputData();
    }

    public function testNonExceptionIsRaisedForValidDataInput()
    {
        $exception = null;
        $input = new CommandLineInput();
        $input->setInputFile($this->getDummyStdInFile());

        $inputText = "7
        7 5 12345
        5 0 4
        10 5 15
        17 8 54321
        499999993 9 1000000000
        10 5 187
        2 0 999999999";

        $this->setDataInDummyStdIn($inputText);

        try {
            $data = $input->getInputData();
        } catch (\Exception $exception) {}

        $this->assertNull($exception, 'Unexpected Exception');
    }
}