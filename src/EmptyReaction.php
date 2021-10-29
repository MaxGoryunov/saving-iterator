<?php

namespace MaxGoryunov\SavingIterator\Src;

use BadMethodCallException;

/**
 * Reactions which return the object as it is.
 * @template T
 * @implements Reaction<T>
 */
final class EmptyReaction implements Reaction
{

    /**
     * {@inheritDoc}
     */
    public function edited(mixed $subject, string $method): mixed
    {

        return ($method !== "")
        ? $subject
        : throw new BadMethodCallException(
            "Empty method call is not allowed for empty reaction"
        );
    }
}
