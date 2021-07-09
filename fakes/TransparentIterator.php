<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Iterator;

class TransparentIterator implements Iterator
{

    /**
     * Original object.
     * 
     * This is NOT necessarily an iterator
     * 
     * @var object
     */
    private object $origin;

    /**
     * Ctor.
     *
     * @param object $iterable
     */
    public function __construct(object $iterable)
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