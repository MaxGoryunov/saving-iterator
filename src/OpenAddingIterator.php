<?php

namespace MaxGoryunov\SavingIterator\Src;

use ArrayAccess;
use Iterator;

/**
 * Adding iterator which stores values in a user provided iterator.
 * @template TKey
 * @template TValue
 * @implements AddingIterator<TKey, TValue>
 */
final class OpenAddingIterator implements AddingIterator
{

    /**
     * Ctor.
     * 
     * @phpstan-param Iterator<TKey, TValue>&ArrayAccess<TKey, TValue> $added
     * @param Iterator&ArrayAccess $added iterator with stored values.
     */
    public function __construct(
        /**
         * Iterator with stored values.
         * 
         * @phpstan-var Iterator<TKey, TValue>&ArrayAccess<TKey, TValue>
         * @var Iterator&ArrayAccess
         */
        private Iterator|ArrayAccess $added
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function from(Iterator $source): AddingIterator
    {
        $updated                   = clone $this->added;
        $updated[$source->key()] ??= $source->current();
        return new self($updated);
    }

    /**
     * {@inheritDoc}
     */
    public function current(): mixed
    {
        return $this->added->current();
    }

    /**
     * {@inheritDoc}
     */
    public function key(): mixed
    {
        return $this->added->key();
    }

    /**
     * {@inheritDoc}
     */
    public function next(): void
    {
        $this->added->next();
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return $this->added->valid();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        $this->added->rewind();
    }
}
