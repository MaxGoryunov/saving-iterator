<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Src\Scalar;

/**
 * Class for applying contexts to elements without changing them.
 * 
 * @todo #44:20min Classes Let and The do not have proper type hints in
 *  constructor and methods. Workarounds with `@var` tags must be removed
 *  after that. 
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
    public function value(): mixed
    {
        ($this->context)($this->subject);
        return $this->subject;
    }
}
