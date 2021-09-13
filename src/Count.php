<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Counts how many times something happened.
 */
interface Count
{

    /**
     * Returns a counter with an incremented value.
     *
     * @return self
     */
    public function increment(): self;

    /**
     * Returns the number of times something happened.
     *
     * @return int
     */
    public function value(): int;
}
