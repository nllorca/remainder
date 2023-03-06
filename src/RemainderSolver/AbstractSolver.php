<?php

namespace Remainder\RemainderSolver;

use Remainder\RemainderSolver\Contracts\SolverInterface;
use Remainder\RemainderSolver\Exceptions\InvalidParameterException;

abstract class AbstractSolver implements SolverInterface
{
    private const MIN_X = 2;
    private const MAX_X = 10 ** 9;
    private const MIN_Y = 0;
    private const MAX_N = 10 ** 9;
    private const PARAM_X = 'X';
    private const PARAM_Y = 'Y';
    private const PARAM_N = 'N';

    private function getInvalidParameterErroMessage(string $parameter, string $min, string $max): string
    {
        return strtr(
            'Invalidad parameter %parameter. Must be an integer that satisfies: %min <= %parameter <= %max',
            [
                '%parameter' => $parameter,
                '%min' => $min,
                '%max' => $max
            ]
        );
    }

    private function validateParameters(int $x, int $y, int $n): void
    {
        $errorMessages = [];

        if (!is_int($x) || $x < self::MIN_X || $x > self::MAX_X) {
            $errorMessages[] = $this->getInvalidParameterErroMessage(self::PARAM_X, self::MIN_X, self::MAX_X);
        }

        if (!is_int($y) || $y < self::MIN_Y || $y >= $x) {
            $errorMessages[] = $this->getInvalidParameterErroMessage(self::PARAM_Y, self::MIN_Y, self::PARAM_X . '-1');
        }

        if (!is_int($n) || $n < $y || $n > self::MAX_N) {
            $errorMessages[] = $this->getInvalidParameterErroMessage(self::PARAM_N, self::PARAM_Y, self::MAX_N);
        }

        if (!empty($errorMessages)) {
            throw new InvalidParameterException(implode(' | ', $errorMessages));
        }
    }

    public function solve(int $x, int $y, int $n): int
    {
        $this->validateParameters($x, $y, $n);
        return $this->solveStrategy($x, $y, $n);
    }

    abstract protected function solveStrategy(int $x, int $y, int $n): int;
}
