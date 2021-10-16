<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Reactions which return the object as it is.
 * @template T
 * @implements Reactions<T>
 */
final class EmptyReactions implements Reactions
{

    /**
     * {@inheritDoc}
     */
    public function edited(mixed $subject, string $method): mixed
    {
        return $subject;
    }
}
