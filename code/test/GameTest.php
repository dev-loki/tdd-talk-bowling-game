<?php

/**
 * Test challenges:
 *  - Test that we don't roll more than allowed!
 *    (Keep in mind the difference in rolls, when rolling strikes!)
 *  - Test that we only roll valid pins (1-10)
 */

declare(strict_types=1);

namespace LokiDev\Bowling\Test;

use LokiDev\Bowling\Game;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    private Game $game;

    /** @dataProvider provideRolls */
    public function testRolls(array $rolls, int $expectedScore): void
    {
        foreach($rolls as $roll) {
            $this->game->roll($roll);
        }

        self::assertSame($expectedScore, $this->game->score());
    }

    public function provideRolls(): array
    {
        return [
            '20 x 0' => [array_fill(0, 20, 0), 0],
            '20 x 1' => [array_fill(0, 20, 1), 20],
            'one spare' => [array_merge([5, 5, 5], array_fill(0, 17, 0)), 20],

            // Exactly 19 rolls, as 10 will ignore the rest of the frame!
            'one strike' => [array_merge([10, 2, 3], array_fill(0, 16, 0)), 20],
            'perfect game' => [array_fill(0, 12, 10), 300],
        ];
    }

    public function setUp(): void
    {
        $this->game = new Game();
    }
}
