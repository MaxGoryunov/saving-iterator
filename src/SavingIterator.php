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
     * Veil for Adding Iterator.
     * Veil is added so that 'from' method is not called manually on methods 
     * 'current' and 'key'.
     *
     * @phpstan-var Indifferent<AddingIterator<TKey, TValue>>
     * @var Indifferent
     */
    private Indifferent $target;

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
        AddingIterator $target
    ) {
        $this->target = new ContextVeil(
            $target,
            fn (AddingIterator $stored): AddingIterator => $stored->from(
                $this->origin
            ),
            [
                "current" => true,
                "key"     => true
            ]
        );
    }
    /**
     * {@inheritDoc}
     * @return TValue|false
     */
    public function current(): mixed
    {
        return $this->target->current();
    }

    /**
     * {@inheritDoc}
     * @return TKey|null
     */
    public function key(): mixed
    {
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
