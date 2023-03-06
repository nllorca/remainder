<?php
namespace Remainder;

use PHPUnit\Framework\TestCase;
use Remainder\RemainderSolver\SimpleSolver;
use Remainder\RemainderSolver\Exceptions\InvalidParameterException;

class SimpleSolverTest extends TestCase
{
    public function testExceptionIsRaisedForInvalidXParameterWhenMinFails()
    {
        $this->expectException(InvalidParameterException::class);
        $solver  = new SimpleSolver();
        $solver->solve(1, 5, 12345);
    }

    public function testExceptionIsRaisedForInvalidXParameterWhenMaxFails()
    {
        $this->expectException(InvalidParameterException::class);
        $solver  = new SimpleSolver();
        $solver->solve(10 ** 10, 5, 12345);
    }

    public function testExceptionIsRaisedForInvalidYParameterWhenMinFails()
    {
        $this->expectException(InvalidParameterException::class);
        $solver  = new SimpleSolver();
        $solver->solve(7, -1, 12345);
    }

    public function testExceptionIsRaisedForInvalidYParameterWhenMaxFails()
    {
        $this->expectException(InvalidParameterException::class);
        $solver  = new SimpleSolver();
        $solver->solve(7, 8, 12345);
    }

    public function testExceptionIsRaisedForInvalidNParameterWhenMinFails()
    {
        $this->expectException(InvalidParameterException::class);
        $solver  = new SimpleSolver();
        $solver->solve(7, 5, 4);
    }

    public function testExceptionIsRaisedForInvalidNParameterWhenMaxFails()
    {
        $this->expectException(InvalidParameterException::class);
        $solver  = new SimpleSolver();
        $solver->solve(7, 5, 10 ** 10);
    }

    public static function solveProvider(): array
    {
        return [
            [7, 5, 12345, 12339],
            [5, 0, 4, 0],
            [10, 5, 15, 15],
            [17, 8, 54321, 54306],
            [499999993, 9, 1000000000, 999999995],
            [10, 5, 187, 185],
            [2, 0, 999999999, 999999998],
        ];
    }

    /**
    * @dataProvider solveProvider
    */
    public function testSolve(int $x, int $y, int $n, int $expected)
    {
        $solver  = new SimpleSolver();
        $this->assertSame($expected, $solver->solve($x, $y, $n));
    }

}