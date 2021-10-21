<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Iterator;

/**
 * Repetition which coverts iterator to array multiple times.
 * @template TKey
 * @template TValue
 * @extends RepetitionEnvelope<Iterator<TKey,TValue>, array<array<TKey, TValue>>>
 */
final class RpIteratorToArray extends RepetitionEnvelope
{

    /**
     * Ctor.
     *
     * @phpstan-param Iterator<TKey, TValue> $source
     * @param Iterator $source source iterator.
     */
    public function __construct(
        Iterator $source
    ) {
        parent::__construct(
            $source,
            fn (Iterator $source): array => iterator_to_array($source)
        );
    }
}
