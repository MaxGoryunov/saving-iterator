<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Src\Scalar;

/**
 * Allows to use context instead of creating a new variable.
 * 
 * @todo #44:25min Classes Let and The contain some repeated cdde which could
 *  be extracted into a separate class.
 * @template X subject type
 * @template Y result type
 * @implements \MaxGoryunov\SavingIterator\Src\Scalar<Y>
 */
class Let implements Scalar
{

    /**
     * Ctor.
     * 
     * @param X             $subject
     * @param Closure(X): Y $context
     */
    public function __construct(
        /**
         * Element to be put into the context.
         * 
         * @var X
         */
        private mixed $subject,

        /**
         * Context for the element.
         * 
         * @var Closure(X): Y
         */
        private Closure $context
    ) {
    }

    /**
     * Returns result of applying context to element.
     *
     * @return Y
     */
    public function value(): mixed
    {
        return ($this->context)($this->subject);
    }
}
