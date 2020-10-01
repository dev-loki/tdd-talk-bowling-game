<?php

declare(strict_types=1);

namespace LokiDev\Bowling\Test;

use LokiDev\Bowling\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    final public function testGameExists(): void
    {
        $game = new Game();
        self::assertNotEmpty($game);
        self::assertTrue(method_exists($game, 'score'), 'Check for methods');
        self::assertTrue(method_exists($game, 'roll'), 'Check for methods');
    }

    final public function testMinimalOutcome(): void
    {
        $game = new Game();

        for ($i = 0; $i < 20; $i++) {
            $game->roll(0);
        }

        self::assertSame(0, $game->score());
    }
}
