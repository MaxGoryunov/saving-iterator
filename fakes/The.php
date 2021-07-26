<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Src\Scalar;

/**
 * Class for applying contexts to elements without changing them.
 */
class The implements Scalar
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
     * Applies context to subject and returns subject.
     *
     * @return mixed
     */
    public function value(): array
    {
        ($this->context)($this->subject);
        return $this->subject;
    }
}
