<?php

namespace App\Domain\Values;

final readonly class ReadingTime
{
    private int $minutes;

    public function __construct(string $content, int $wordsPerMinute = 200)
    {
        $words = str_word_count(strip_tags($content));
        $this->minutes = max(1, (int) ceil($words / $wordsPerMinute));
    }

    public function minutes(): int
    {
        return $this->minutes;
    }

    public function label(): string
    {
        return "{$this->minutes} Menit Baca";
    }

    public function __toString(): string
    {
        return (string) $this->minutes;
    }
}
