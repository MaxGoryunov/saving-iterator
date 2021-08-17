<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Storage for Iterator values.
 * @template TKey
 * @template TValue
 */
interface Storage
{

    /**
     * Returns object with added values from iterator.
     *
     * @phpstan-param Iterator<TKey, TValue> $source
     * @param Iterator $source iterator from which the values are taken.
     * @return static
     */
    public function added(Iterator $source): static;

    /**
     * Current key.
     *
     * @phpstan-return TKey
     * @return mixed
     */
    public function key(): mixed;

    /**
     * Current value.
     *
     * @phpstan-return TValue
     * @return mixed
     */
    public function value(): mixed;

    /**
     * Resets storage pointer to the beginning.
     *
     * @return static
     */
    public function rewind(): static;

    /**
     * Moves pointer to next key-value pair.
     *
     * @return static
     */
    public function next(): static;
}
