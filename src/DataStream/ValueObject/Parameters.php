<?php

namespace Remainder\DataStream\ValueObject;

class Parameters 
{
    private int $x;
    private int $y;
    private int $n;

    public function __construct(int $x, int $y, int $n)
    {
        $this->x = $x;
        $this->y = $y;
        $this->n = $n;
    }

    public final function getX(): int
    {
        return $this->x;
    }

    public final function getY(): int
    {
        return $this->y;
    }

    public final function getN(): int
    {
        return $this->n;
    }
}