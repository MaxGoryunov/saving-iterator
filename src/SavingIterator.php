<?php

namespace MaxGoryunov\SavingIterator\Src;

use Closure;
use Iterator;
use Generator;

/**
 * Iterator which stores iterated values.
 * 
 * @todo #195:15min README has to mention that now it is not required to
 *  create ArrayAddingIterator and pass it into the constructor because now it
 *  is a default option.
 * 
 * @template TKey
 * @template TValue
 * @extends IteratorEnvelope<TKey, TValue>
 */
final class SavingIterator extends IteratorEnvelope
{
    /**
     * Ctor.
     * 
     * @phpstan-param Iterator<TKey, TValue>|Closure():Generator<TKey, TValue, void, void> $origin
     * @phpstan-param AddingIterator<TKey, TValue> $target
     * @param Iterator|Closure $origin original iterator.
     * @param AddingIterator   $target iterator to which the values are saved.
     */
    public function __construct(
        Iterator|Closure $origin,
        AddingIterator $target = new ArrayAddingIterator()
    ) {
        $reorigin = ($origin instanceof Closure) ? $origin() : $origin;
        /**
         * @todo #194:15min README has to show that it is now possible to 
         *  directly pass Generator Closures into constructor without 
         *  having to manually call them.
         */
        parent::__construct(
            /** @phpstan-ignore-next-line */
            new ContextVeil(
                $target,
                /**
                 * @todo #196:60min There are phpstan issues with
                 *  ClosureReaction here and in ContextVeilTest. Now they are
                 *  fixed by ignore-line stubs but need to be fixed according
                 *  to phpstan ruleset.
                 */
                /** @phpstan-ignore-next-line */
                new ClosureReaction(
                    /**
                     * @phpstan-param AddingIterator<TKey, TValue> $stored
                     * Iterator for value storage.
                     */
                    fn (AddingIterator $stored) => (new ValidTernary(
                        $reorigin,
                        function (Iterator $source) use ($stored) {
                            $temp = $stored->from($source);
                            $source->next();
                            return $temp;
                        },
                        fn () => $stored
                    ))->value()
                )
            )
        );
    }
}
