<?php

declare(strict_types=1);

namespace LokiDev\Bowling;

class Game implements BowlingInterface
{
    private int $score = 0;

    public function roll(int $pins): void
    {
        $this->score += $pins;
    }

    public function score(): int
    {
        return $this->score;
    }
}
