<?php

declare(strict_types=1);

namespace LokiDev\Bowling;

class Game implements BowlingInterface
{
    public function roll(int $pins): void
    {
    }

    public function score(): int
    {
        return 0;
    }
}
