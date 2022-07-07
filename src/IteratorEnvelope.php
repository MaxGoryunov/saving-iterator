<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Wraps objects which are not interators.
 *
 * @template TKey
 * @template TValue
 *
 * @implements Iterator<TKey, TValue>
 */
class IteratorEnvelope implements Iterator
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
     * @param Iterator<TKey, TValue>|Indifferent<Iterator<TKey, TValue>>
     * $iterable
     */
    public function __construct(Iterator|Indifferent $iterable)
    {
        $this->origin = $iterable;
    }

    public function current(): mixed
    {
        return $this->origin->current();
    }

    public function key(): mixed
    {
        return $this->origin->key();
    }

    public function valid(): bool
    {
        return $this->origin->valid();
    }

    public function next(): void
    {
        $this->origin->next();
    }

    public function rewind(): void
    {
        $this->origin->rewind();
    }
}
