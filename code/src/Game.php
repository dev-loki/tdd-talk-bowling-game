<?php

declare(strict_types=1);

namespace LokiDev\Bowling;

final class Game implements BowlingInterface
{
    private const ALL_PINS = 10;

    private const TOTAL_FRAMES = 10;

    /** @var int[] */
    private array $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $totalScore = 0;

        $rollIndex = 0;
        for($frame = 0; $frame < self::TOTAL_FRAMES; $frame++) {
            $totalScore += $this->currentFramePins($rollIndex);
            if ($this->isStrike($rollIndex)) {
                $totalScore += $this->bonusFromStrike($rollIndex);
                $rollIndex += 1;
            } else if ($this->isSpare($rollIndex)) {
                $totalScore += $this->bonusFromSpare($rollIndex);
                $rollIndex += 2;
            } else {
                $rollIndex += 2;
            }
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
        return $this->currentFramePins($i) === self::ALL_PINS && !$this->isStrike($i);
    }

    private function isStrike(int $i): bool
    {
        return $this->rolls[$i] === self::ALL_PINS;
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
