<?php

namespace App\Services;

class ReadingTimeEstimator
{
    public function estimate(string $content, int $wpm = 200): int
    {
        $words = str_word_count(strip_tags($content));
        return max(1, (int) ceil($words / $wpm));
    }
}
