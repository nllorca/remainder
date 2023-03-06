<?php

namespace Remainder\RemainderSolver\Contracts;

interface SolverInterface {
    public function solve(int $x, int $y, int $n): int;
}