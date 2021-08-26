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
     * @phpstan-param Closure(mixed): T $context 
     * @param Closure $context
     * @phpstan-return T
     * @return mixed
     */
    public function do(Closure $context): mixed;
}
