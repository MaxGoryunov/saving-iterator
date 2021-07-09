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
     * Cached values from the inner iterator
     * 
     * @var array
     */
    private array $saved = [];
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
        if (($this->origin->valid()) && (!isset($this->saved[$this->origin->key()]))) {
            $this->saved[$this->origin->key()] = $this->origin->current();
        }
        return current($this->saved);
    }

    /**
     * {@inheritDoc}
     */
    public function key(): mixed
    {
        if (($this->origin->valid()) && (!isset($this->saved[$this->origin->key()]))) {
            $this->saved[$this->origin->key()] = $this->origin->current();
        }
        return key($this->saved);
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
        if ($this->origin->valid()) {
            $this->origin->next();
        }
        next($this->saved);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        reset($this->saved);
    }
}
