<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Adding iterator which only adds values if source is valid.
 *
 * @template TKey
 * @template TValue
 *
 * @implements AddingIterator<TKey, TValue>
 */
final class ValidAddingIterator implements AddingIterator
{

    /**
     * Ctor.
     *
     * @phpstan-param AddingIterator<TKey, TValue> $origin
     *
     * @param AddingIterator $origin original adding iterator.
     */
    public function __construct(
        /**
         * Original adding iterator.
         *
         * @phpstan-var AddingIterator<TKey, TValue>
         *
         * @var AddingIterator
         */
        private AddingIterator $origin
    ) {
    }

    /**
     * {@inheritDoc}
     * Only adds values if source is valid.
     */
    public function from(Iterator $source): AddingIterator
    {
        return (new ValidTernary(
            $source,
            fn (Iterator $iter) => new self($this->origin->from($iter)),
            fn () => $this
        ))->value();
    }

    public function current(): mixed
    {
        return $this->origin->current();
    }

    public function key(): mixed
    {
        return $this->origin->key();
    }

    public function next(): void
    {
        $this->origin->next();
    }

    public function valid(): bool
    {
        return $this->origin->valid();
    }

    public function rewind(): void
    {
        $this->origin->rewind();
    }
}
