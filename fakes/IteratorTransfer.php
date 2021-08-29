<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Iterator;
use MaxGoryunov\SavingIterator\Src\AddingIterator;

/**
 * Performs transfer of values from iterator to adding iterator.
 * @template TKey
 * @template TValue
 */
final class IteratorTransfer
{

    /**
     * Ctor.
     * 
     * @phpstan-param Iterator<TKey, TValue> $origin
     * @param Iterator $origin original iterator.
     */
    public function __construct(
        /**
         * Original iterator.
         *
         * @phpstan-var Iterator<TKey, TValue>
         * @var Iterator
         */
        private Iterator $origin
    ) {
    }

    /**
     * Transfers all values from origin to target.
     *
     * @phpstan-param AddingIterator<TKey, TValue> $target
     * @param AddingIterator $target
     * @phpstan-return AddingIterator<TKey, TValue>
     * @return AddingIterator
     */
    public function toTarget(AddingIterator $target): AddingIterator
    {
        $this->origin->rewind();
        while ($this->origin->valid()) {
            $target = $target->from($this->origin);
            $this->origin->next();
        }
        return $target;
    }
}
