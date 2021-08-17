<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Base storage implementation.
 * @todo #66:15min Remove this unused class and its test.
 */
final class BaseStorage implements Storage
{

    /**
     * Ctor.
     * 
     * @param array $stored
     */
    public function __construct(
        /**
         * Stored iterator values.
         * 
         * @var array
         */
        private array $stored = []
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function added(Iterator $source): static
    {
        $this->stored[$source->key()] = $source->current();
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function value(): mixed
    {
        return current($this->stored);
    }

    /**
     * {@inheritDoc}
     */
    public function key(): mixed
    {
        return key($this->stored);
    }

    public function rewind(): static
    {
        return $this;
    }

    public function next(): static
    {
        return $this;
    }
}
