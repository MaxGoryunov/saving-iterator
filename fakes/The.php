<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Src\Scalar;

/**
 * Class for applying contexts to elements without changing them.
 * @template T subject type.
 * @implements Scalar<T>
 * 
 * @todo #44:20min Classes Let and The do not have proper type hints in
 *  constructor and methods. Workarounds with `@var` tags must be removed
 *  after that.
 * @template T subject type
 * @implements \MaxGoryunov\SavingIterator\Src\Scalar<T>
 */
class The implements Scalar
{

    /**
     * Ctor.
     * 
     * @param T                 $subject
     * @param Closure(T): mixed $context
     */
    public function __construct(
        /**
         * Element to be put into the context.
         * 
         * @var T
         */
        private mixed $subject,

        /**
         * Context for the element.
         * 
         * @var Closure(T): mixed
         */
        private Closure $context
    ) {
    }

    /**
     * Applies context to subject and returns subject.
     *
     * @return T
     */
    public function value(): mixed
    {
        ($this->context)($this->subject);
        return $this->subject;
    }
}
