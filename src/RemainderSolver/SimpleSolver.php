<?php

namespace Remainder\RemainderSolver;

use Remainder\RemainderSolver\AbstractSolver;

class SimpleSolver extends AbstractSolver
{
    protected function solveStrategy(int $x, int $y, int $n): int
    {
        for ($i = $n; $i >= 0; $i--) {
            if ($i % $x == $y) {
                break;
            }
        }
        return $i;
    }
}
