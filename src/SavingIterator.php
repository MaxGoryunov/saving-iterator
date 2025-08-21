<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Iterator which stores iterated values.
 * @template TKey
 * @template TValue
 * @extends IteratorEnvelope<TKey, TValue>
 */
final class SavingIterator extends IteratorEnvelope
{
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
                        $origin,
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
