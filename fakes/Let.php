<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Allows to use context instead of creating a new variable.
 */
class Let
{

    /**
     * Ctor.
     * 
     * @param mixed   $subject
     * @param Closure $context
     */
    public function __construct(
        /**
         * Element to be put into the context.
         * 
         * @var mixed
         */
        private mixed $subject,

        /**
         * Context for the element.
         * 
         * @var Closure
         */
        private Closure $context
    ) {
    }

    /**
     * Returns result of applying context to element.
     *
     * @return mixed
     */
    public function value(): mixed
    {
        return ($this->context)($this->subject);
    }
}
