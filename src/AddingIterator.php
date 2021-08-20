<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Iterator which can add values.
 * @todo #66:30min Add implementation for this interface.
 * @template TKey
 * @template TValue
 * @extends Iterator<TKey, TValue>
 */
interface AddingIterator extends Iterator
{

    /**
     * Returns an iterator with an added value from source iterator.
     *
     * @phpstan-param Iterator<TKey, TValue> $source
     * @phpstan-return self<TKey,TValue>
     * @param Iterator $source iterator from which the value is taken.
     * @return self
     */
    public function from(Iterator $source): self;
}
