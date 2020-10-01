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
}
