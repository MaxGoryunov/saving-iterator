<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Repeats some process several times and returns its result.
 * @template X subject type
 * @template Y result type
 * @implements Repetition<Y>
 */
abstract class RepetitionEnvelope implements Repetition
{
    /**
     * Ctor.
     *
     * @phpstan-param T             $subject
     * @phpstan-param Closure(T): Y $context
     * @param mixed   $subject element to be processed.
     * @param Closure $context context for the element.
     */
    public function __construct(
        /**
         * Element to be processed.
         *
         * @phpstan-var X
         * @var mixed
         */
        private mixed $subject,

        /**
         * Context for the element.
         *
         * @phpstan-var Closure(X): Y
         * @var Closure
         */
        private Closure $context
    ) {
    }

    /**
     * Returns several results of applying context to subject.
     *
     * @param int $count
     * @phpstan-return Y[]
     * @return mixed[]
     */
    final public function times(int $count): array
    {
        return array_map(
            $this->context,
            array_fill_keys(range(0, $count - 1), $this->subject)
        );
    }
}
