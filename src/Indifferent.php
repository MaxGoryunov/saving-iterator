<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Interface for objects on which any methods can be called.
 *
 * @template T of object
 *
 * @mixin T
 */
interface Indifferent
{

    /**
     * Returns result of any called method.
     *
     * @param array<mixed> $arguments
     */
    public function __call(string $name, array $arguments): mixed;
}
