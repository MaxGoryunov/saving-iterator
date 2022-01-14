<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Execution block.
 * @template T
 */
interface Block
{

    /**
     * Returns result of applying context to subject.
     *
     * @phpstan-param Closure(mixed): mixed $context
     * @param Closure $context
     * @phpstan-return T
     * @return mixed
     */
    public function act(Closure $context): mixed;
}
