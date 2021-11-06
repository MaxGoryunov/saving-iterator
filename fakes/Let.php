<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Allows to use context instead of creating a new variable.
 * @todo #124:90min Move common functionality from Let and The to the parent
 *  class.
 * @template X subject type
 * @template Y result type
 * @implements Block<Y>
 */
class Let implements Block
{

    /**
     * Ctor.
     *
     * @param mixed $subject element for context.
     */
    public function __construct(
        /**
         * Subject for context.
         *
         * @var mixed
         */
        private mixed $subject
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function act(Closure $context): mixed
    {
        return $context($this->subject);
    }
}
