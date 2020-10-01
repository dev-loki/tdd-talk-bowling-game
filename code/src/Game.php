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
            $frameScore = $this->currentFramePins($i);
            if ($this->isStrike($i)) {
                $frameScore += $this->bonusFromStrike($i);
                $i--; // we have one roll less!
            } else if ($this->isSpare($i)) {
                $frameScore += $this->bonusFromSpare($i);
            }
            $totalScore += $frameScore;
        }

        return $totalScore;
    }

    private function currentFramePins(int $i): int
    {
        if ($this->isStrike($i)) {
            return $this->rolls[$i];
        }

        return $this->rolls[$i] + $this->rolls[$i + 1];
    }

    private function isSpare(int $i): bool
    {
        return $this->currentFramePins($i) === 10 && !$this->isStrike($i);
    }

    private function isStrike(int $i): bool
    {
        return $this->rolls[$i] === 10;
    }

    private function bonusFromSpare(int $i): int
    {
        return $this->rolls[$i + 2];
    }

    private function bonusFromStrike(int $i): int
    {
        return $this->rolls[$i + 1] + $this->rolls[$i + 2];
    }
}
