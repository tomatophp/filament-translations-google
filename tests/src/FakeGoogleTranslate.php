<?php

namespace TomatoPHP\FilamentTranslationsGoogle\Tests;

use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * Stands in for Google Translate so the tests never call the network.
 */
class FakeGoogleTranslate extends GoogleTranslate
{
    /** @var array<int, string> */
    public array $translated = [];

    public function translate(string $string): ?string
    {
        $this->translated[] = $string;

        return '[' . $this->target . '] ' . $string;
    }
}
