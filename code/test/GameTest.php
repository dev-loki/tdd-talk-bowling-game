<?php

declare(strict_types=1);

namespace LokiDev\Bowling\Test;

use LokiDev\Bowling\Game;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    private Game $game;

    public function testMinimalOutcome(): void
    {
        $this->rollPinsMultipleTimes(0, 20);

        self::assertSame(0, $this->game->score());
    }

    public function testAnotherMinimalOutcome(): void
    {
        $this->rollPinsMultipleTimes(1, 20);

        self::assertSame(20, $this->game->score());
    }

    private function rollPinsMultipleTimes(int $pins, int $times): void
    {
        for ($i = 0; $i < $times; $i++) {
            $this->game->roll($pins);
        }
    }

    public function setUp(): void
    {
        $this->game = new Game();
    }
}
