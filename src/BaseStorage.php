<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Base storage implementation.
 */
final class BaseStorage
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
        if ($source->valid()) {
            $this->stored[$source->key()] = $source->current();
        }
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
}
