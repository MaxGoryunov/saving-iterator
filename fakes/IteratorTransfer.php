<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Iterator;
use MaxGoryunov\SavingIterator\Src\AddingIterator;

/**
 * Performs transfer of values from iterator to adding iterator.
 */
final class IteratorTransfer
{

    /**
     * Ctor.
     * 
     * @param Iterator $origin original iterator.
     */
    public function __construct(
        /**
         * Original iterator.
         *
         * @var Iterator
         */
        private Iterator $origin
    ) {
    }

    /**
     * Transfers all values from origin to target.
     *
     * @param AddingIterator $target
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
