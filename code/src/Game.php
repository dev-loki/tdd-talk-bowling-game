<?php

declare(strict_types=1);

namespace LokiDev\Bowling;

class Game implements BowlingInterface
{
    /** @var int[] */
    private $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $totalScore = 0;
        $length = count($this->rolls);

        for ($i = 0; $i < $length-1; $i += 2) {
            $tempScore = $this->rolls[$i] + $this->rolls[$i+1];
            if ($tempScore === 10) {
                $tempScore += $this->rolls[$i + 2];
            }
            $totalScore += $tempScore;
        }

        return $totalScore;
    }
}
