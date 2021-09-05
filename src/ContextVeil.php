<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Veil which applies context to origin if the condition is met.
 * @template T of object origin type.
 * @implements Indifferent<T>
 * @mixin T
 */
final class ContextVeil implements Indifferent
{

    /**
     * Ctor.
     * 
     * @phpstan-param T $origin
     * @param object $origin original element.
     */
    public function __construct(
        /**
         * Original element.
         *
         * @phpstan-var T
         * @var object
         */
        private object $origin
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
