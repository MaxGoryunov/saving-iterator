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
     * Returns target after adding a value from origin.
     *
     * @return AddingIterator
     */
    private function added(): AddingIterator
    {
        $this->target = $this->target->from($this->origin);
        return $this->target;
    }

    /**
     * {@inheritDoc}
     * @return TValue|false
     */
    public function current(): mixed
    {
        /**
         * @todo #66:25min Codebeat complains about similar code in two methods.
         *  It should be refactored.
         */
        $this->target = $this->target->from($this->origin);
        return $this->added()->current();
    }

    /**
     * {@inheritDoc}
     * @return TKey|null
     */
    public function key(): mixed
    {
        return $this->added()->key();
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
