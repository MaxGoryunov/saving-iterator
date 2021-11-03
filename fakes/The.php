<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Class for applying contexts to elements without changing them.
 * @template T subject type
 * @implements Block<mixed>
 */
class The implements Block
{

    /**
     * Ctor.
     *
     * @phpstan-param T $subject
     * @param mixed $subject repeating element.
     */
    public function __construct(
        /**
         * Subject for a context.
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
        $context($this->subject);
        return $this->subject;
    }
}
