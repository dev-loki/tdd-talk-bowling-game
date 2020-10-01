<?php

declare(strict_types=1);

namespace LokiDev\Bowling;

interface BowlingInterface
{
    public function roll(int $pins): void;

    public function score(): int;
}
