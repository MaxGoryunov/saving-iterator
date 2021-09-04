<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Veil which applies context to origin if the condition is met.
 */
final class ContextVeil implements Indifferent
{

    /**
     * Ctor.
     * 
     * @param mixed $origin original element.
     */
    public function __construct(
        /**
         * Original element.
         *
         * @var mixed
         */
        private mixed $origin
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function __call(string $name, array $arguments): mixed
    {
        return $this->origin->$name(...$arguments);
    }
}
