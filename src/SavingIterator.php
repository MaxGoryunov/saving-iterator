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
     * Original iterator
     * 
     * @var Iterator<TKey, TValue>
     */
    private Iterator $origin;

    /**
     * Cached values from the inner iterator
     * 
     * @var array<TKey, TValue>
     */
    private array $saved = [];
    /**
     * Ctor.
     *
     * @param Iterator<TKey, TValue> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->origin = $iterator;
    }

    /**
     * {@inheritDoc}
     * @return TValue|false
     */
    public function current(): mixed
    {
        return $this->saved[$this->key()];
    }

    /**
     * {@inheritDoc}
     * @return TKey|null
     */
    public function key(): mixed
    {
        if ($this->origin->valid()) {
            $this->saved[$this->origin->key()] ??= $this->origin->current();
        }
        return key($this->saved);
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return ($this->origin->valid()) || (key($this->saved) !== null);
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
