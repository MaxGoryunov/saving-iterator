<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Iterator which stores iterated values.
 * @template TKey
 * @template TValue
 * @implements Iterator<TKey, TValue>
 */
class SavingIterator implements Iterator
{

    /**
     * Ctor.
     * 
     * @phpstan-param Iterator<TKey, TValue>       $origin
     * @phpstan-param AddingIterator<TKey, TValue> $target
     * @param Iterator       $origin original iterator.
     * @param AddingIterator $target iterator to which the values are saved.
     */
    public function __construct(
        /**
         * Original iterator.
         *
         * @phpstan-var Iterator<TKey, TValue>
         * @var Iterator
         */
        private Iterator $origin,

        /**
         * Iterator to which the values are saved.
         *
         * @phpstan-var AddingIterator<TKey, TValue>
         * @var AddingIterator
         */
        private AddingIterator $target
    ) {
    }

    /**
     * {@inheritDoc}
     * @return TValue|false
     */
    public function current(): mixed
    {
        $this->target = $this->target->from($this->origin);
        return $this->target->current();
    }

    /**
     * {@inheritDoc}
     * @return TKey|null
     */
    public function key(): mixed
    {
        $this->target = $this->target->from($this->origin);
        return $this->target->key();
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return ($this->origin->valid()) || ($this->target->valid());
    }

    /**
     * {@inheritDoc}
     */
    public function next(): void
    {
        if ($this->origin->valid()) {
            $this->origin->next();
        }
        $this->target->next();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        $this->target->rewind();
    }
}
