<?php

namespace MaxGoryunov\SavingIterator\Src;

use Closure;
use Iterator;

/**
 * Iterator which stores iterated values.
 * @template TKey
 * @template TValue
 * @implements Iterator<TKey, TValue>
 */
class SavingIterator implements Iterator
{

    /**
     * Veil for Adding Iterator.
     * Veil is added so that 'from' method is not called manually on methods 
     * 'current' and 'key'.
     *
     * @phpstan-var Indifferent<AddingIterator<TKey, TValue>>
     * @var Indifferent
     */
    private Indifferent $target;

    /**
     * Ctor.
     * 
     * @phpstan-param Iterator<TKey, TValue>       $origin
     * @phpstan-param AddingIterator<TKey, TValue> $target
     * @param Iterator       $origin original iterator.
     * @param AddingIterator $target iterator to which the values are saved.
     */
    public function __construct(
        Iterator $origin,
        AddingIterator $target
    ) {
        /**
         * @todo #177:15min SavingIterator has most of its behavior in the
         *  encapsulated ContextVeil. It would be better remove all other
         *  methods and instead inherit from TransparentIterator.
         */
        /** @phpstan-ignore-next-line */
        $this->target = new ContextVeil(
            $target,
            new ClosureReaction(
                function (AddingIterator $stored) use ($origin) {
                    $res = $stored;
                    if ($origin->valid()) {
                        $res = $stored->from($origin);
                        $origin->next();
                    }
                    return $res;
                }
            )
        );
    }

    /**
     * {@inheritDoc}
     * @return TValue|false
     */
    public function current(): mixed
    {
        return $this->target->current();
    }

    /**
     * {@inheritDoc}
     * @return TKey|null
     */
    public function key(): mixed
    {
        return $this->target->key();
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return ($this->target->valid());
    }

    /**
     * {@inheritDoc}
     */
    public function next(): void
    {
        $this->target->next();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        $this->target->rewind();
    }
}
