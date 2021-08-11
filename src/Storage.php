<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Storage for Iterator values.
 */
interface Storage
{

    /**
     * Returns object with added values from iterator.
     *
     * @param Iterator $iterator
     * @return static
     */
    public function added(Iterator $iterator): static;

    /**
     * Current key.
     *
     * @return mixed
     */
    public function key(): mixed;

    /**
     * Current value.
     *
     * @return mixed
     */
    public function value(): mixed;

    /**
     * Resets storage pointer to the beginning.
     *
     * @return static
     */
    public function reset(): static;

    /**
     * Moves pointer to next key-value pair.
     *
     * @return static
     */
    public function next(): static;
}
