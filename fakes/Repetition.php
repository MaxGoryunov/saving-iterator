<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Fakes;

/**
 * Some repeating process.
 *
 * @template T result type
 */
interface Repetition
{
    /**
     * Returns an array of results.
     * Number of values in the result array is the same as $count.
     *
     * @phpstan-return array<T>
     *
     * @return array<mixed>
     */
    public function times(int $count): array;
}
