<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Adding iterator which stores values in an array.
 *
 * @template TKey
 * @template TValue
 *
 * @implements AddingIterator<TKey, TValue>
 */
final class ArrayAddingIterator implements AddingIterator
{

    /**
     * Ctor.
     *
     * @phpstan-param array<TKey, TValue> $added
     *
     * @param array<mixed> $added added values.
     */
    public function __construct(
        /**
         * Added values.
         *
         * @var array<mixed>
         */
        private array $added = []
    ) {
    }

    public function from(Iterator $source): AddingIterator
    {
        return new self(
            array_merge(
                $this->added,
                isset($this->added[$source->key()])
                ? []
                : [$source->key() => $source->current()]
            )
        );
    }

    public function current(): mixed
    {
        return current($this->added);
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-return int|string|null
     */
    public function key(): mixed
    {
        return key($this->added);
    }

    public function next(): void
    {
        next($this->added);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind(): void
    {
        reset($this->added);
    }
}
