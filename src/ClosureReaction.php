<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

use Closure;

/**
 * A reaction which accepts Closure.
 *
 * @template T
 *
 * @implements Reaction<T>
 */
final class ClosureReaction implements Reaction
{

    /**
     * Ctor.
     *
     * @phpstan-param Closure(T, string): T $action
     *
     * @param Closure $action action to be performed.
     */
    public function __construct(
        /**
         * Action to be performed.
         *
         * @phpstan-var Closure(T, string): T
         *
         * @var Closure
         */
        private Closure $action
    ) {
    }

    public function edited(mixed $subject, string $method): mixed
    {
        return ($this->action)($subject, $method);
    }
}
