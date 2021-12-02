<?php

namespace src;

class Steering
{
    protected int $_horizontal = 0;
    protected int $_depth = 0;
    protected int $_aim = 0;

    final public function forward(int $step): void
    {
        $this->_horizontal += $step;
    }

    final public function aimForward(int $step): void
    {
        $this->_horizontal += $step;
        $this->down($step * $this->_aim);
    }

    final public function down(int $step): void
    {
        $this->_depth += $step;
    }

    final public function resetCoordinates(): void
    {
        $this->_aim = 0;
        $this->_depth = 0;
        $this->_horizontal = 0;
    }

    final public function up(int $step): void
    {
        $this->_depth -= $step;
    }

    final public function aim(int $step): void
    {
        $this->_aim += $step;
    }

    final public function getHorizontal(): int
    {
        return $this->_horizontal;
    }

    final public function getDepth(): int
    {
        return $this->_depth;
    }
}