<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Wraps objects which are not interators.
 * 
 * @template TKey
 * @template TValue
 * @implements Iterator<TKey, TValue>
 */
class TransparentIterator implements Iterator
{

    /**
     * Original object.
     * 
     * This is NOT necessarily an iterator
     * 
     * @var Iterator<TKey, TValue>|Indifferent<Iterator<TKey, TValue>>
     */
    private Iterator|Indifferent $origin;

    /**
     * Ctor.
     *
     * @param Iterator<TKey, TValue>|Indifferent<Iterator<TKey, TValue>> $iterable
     */
    public function __construct(Iterator|Indifferent $iterable)
    {
        $this->origin = $iterable;
    }

    /**
     * {@inheritDoc}
     */
    public function current(): mixed
    {
        return $this->origin->current();
    }

    /**
     * {@inheritDoc}
     */
    public function key(): mixed
    {
        return $this->origin->key();
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return $this->origin->valid();
    }

    /**
     * {@inheritDoc}
     */
    public function next(): void
    {
        $this->origin->next();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        $this->origin->rewind();
    }
}
