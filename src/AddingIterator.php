<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Iterator which can add values.
 * @todo #66:30min Add implementation for this interface.
 */
interface AddingIterator extends Iterator
{

    /**
     * Returns an iterator with an added value from source iterator.
     *
     * @param Iterator $source iterator from which the value is taken.
     * @return static
     */
    public function from(Iterator $source): static;
}
