<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Contexts which change the subject.
 *
 * @template T of mixed
 */
interface Reaction
{

    /**
     * Returns a subject modified by stored contexts.
     *
     * @phpstan-param T $subject
     *
     * @param mixed  $subject subject which will be modified.
     * @param string $method  method to see if the modification is necessary.
     *
     * @phpstan-return T
     */
    public function edited(mixed $subject, string $method): mixed;
}
