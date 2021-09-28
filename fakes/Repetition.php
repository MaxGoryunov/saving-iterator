<?php

namespace MaxGoryunov\SavingIterator\Fakes;

/**
 * Some repeating process.
 * @template T result type
 */
interface Repetition
{
    /**
     * Returns an array of results.
     * Number of values in the result array is the same as $count.
     *
     * @param int $count
     * @phpstan-return T[]
     * @return mixed[]
     */
    public function times(int $count): array;
}
