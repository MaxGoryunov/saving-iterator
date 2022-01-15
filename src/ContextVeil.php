<?php

namespace MaxGoryunov\SavingIterator\Src;

use Closure;

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
     * @phpstan-param T           $origin
     * @phpstan-param Reaction<T> $reaction
     * @param object   $origin   original element.
     * @param Reaction $reaction reaction for the element.
     */
    public function __construct(
        /**
         * Original element.
         *
         * @phpstan-var T
         * @var object
         */
        private object $origin,

        /**
         * Reaction for the element.
         *
         * @phpstan-var Reaction<T>
         * @var Reaction
         */
        private Reaction $reaction
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function __call(string $name, array $arguments): mixed
    {
        $this->origin = $this->reaction->edited($this->origin, $name);
        return $this->origin->$name(...$arguments);
    }
}
