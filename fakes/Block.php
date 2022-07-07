<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Execution block.
 *
 * @template T
 */
interface Block
{

    /**
     * Returns result of applying context to subject.
     *
     * @phpstan-param Closure(mixed): mixed $context
     *
     * @phpstan-return T
     */
    public function act(Closure $context): mixed;
}
