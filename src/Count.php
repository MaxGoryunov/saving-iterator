<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Counts how many times something happened.
 */
interface Count
{

    /**
     * Returns a counter with an incremented value.
     */
    public function increment(): self;

    /**
     * Returns the number of times something happened.
     */
    public function value(): int;
}
