<?php

declare(strict_types=1);

namespace LokiDev\Bowling;

final class Game implements BowlingInterface
{
    /** @var int[] */
    private array $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $totalScore = 0;
        $length = count($this->rolls);

        for ($i = 0; $i < $length-1; $i += 2) {
            $frameScore = $this->totalFramePins($i);
            if ($this->isSpare($frameScore)) {
                $frameScore += $this->bonusFromSpare($i);
            }
            $totalScore += $frameScore;
        }

        return $totalScore;
    }

    private function bonusFromSpare(int $i): int
    {
        return $this->rolls[$i + 2];
    }

    private function totalFramePins(int $i): int
    {
        return $this->rolls[$i] + $this->rolls[$i + 1];
    }

    private function isSpare(int $frameScore): bool
    {
        return $frameScore === 10;
    }
}
