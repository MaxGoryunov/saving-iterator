<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

class SavingIterator implements Iterator
{

    /**
     * Original iterator
     * 
     * @var Iterator
     */
    private Iterator $origin;

    /**
     * Ctor.
     *
     * @param Iterator $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->origin = $iterator;
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
