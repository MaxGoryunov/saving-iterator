<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Src\Scalar;

/**
 * Class for wrapping divergent program flows. It allows to structure a program
 * in such a way that there will be no need for a variable if it exists only in
 * order to be used in two places.
 * @template X subject type
 * @template Y result type
 * @implements \MaxGoryunov\SavingIterator\Src\Scalar<Y>
 */
abstract class SurveyEnvelope implements Scalar
{

    /**
     * Ctor.
     * 
     * @phpstan-param X                                $subject
     * @phpstan-param Closure(X): mixed                $context
     * @phpstan-param Closure(X, Closure(X): mixed): Y $usage
     * @param mixed   $subject element to be used in some context
     * @param Closure $context context for element
     * @param Closure $usage   way of combining element and context
     */
    public function __construct(
        /**
         * Element to be used in some context.
         * 
         * @var X
         */
        private mixed $subject,

        /**
         * Context for element.
         * 
         * @var Closure(X): mixed
         */
        private Closure $context,

        /**
         * way of combining element and context.
         * 
         * @var Closure(X, Closure(X): mixed): Y
         */
        private Closure $usage
    ) {
    }

    /**
     * Returns result of applying context to element.
     *
     * @return Y
     */
    public final function value(): mixed
    {
        return ($this->usage)($this->subject, $this->context);
    }
}
