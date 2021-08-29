<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Basic count implementation.
 */
final class BsCount implements Count
{

    /**
     * Ctor.
     * 
     * @param int $count how many times something happened.
     */
    public function __construct(
        /**
         * How many times something happened.
         *
         * @var int
         */
        private int $count = 0
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function increment(): Count
    {
        return new self($this->count + 1);
    }

    /**
     * {@inheritDoc}
     */
    public function value(): int
    {
        return $this->count;
    }
}
