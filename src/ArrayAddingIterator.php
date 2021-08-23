<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Adding iterator which stores values in an array.
 * @template TKey
 * @template TValue
 * @implements AddingIterator<TKey, TValue>
 */
final class ArrayAddingIterator implements AddingIterator
{

    /**
     * Ctor.
     * 
     * @phpstan-param array<TKey, TValue> $added
     * @param mixed[] $added added values.
     */
    public function __construct(
        /**
         * Added values.
         *
         * @var mixed[]
         */
        private array $added = []
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function from(Iterator $source): AddingIterator
    {
        /**
         * @todo #66:20min Add a decorator for AddingIterator which does not
         *  allow to add values if source is not valid.
         */
        if ($source->valid()) {
            $this->added[$source->key()] ??= $source->current();
        }
        return new self($this->added);
    }

    /**
     * {@inheritDoc}
     */
    public function current(): mixed
    {
        return current($this->added);
    }

    /**
     * {@inheritDoc}
     * @phpstan-return int|string|null
     */
    public function key(): mixed
    {
        return key($this->added);
    }

    /**
     * {@inheritDoc}
     */
    public function next(): void
    {
        next($this->added);
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return $this->key() !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        reset($this->added);
    }
}
