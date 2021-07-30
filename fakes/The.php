<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Class for applying contexts to elements without changing them.
 * 
 * @template T subject type
 * @extends SurveyEnvelope<T, T>
 */
class The extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @phpstan-param T                 $subject repeating element
     * @phpstan-param Closure(T): mixed $context context for element
     * @param mixed $subject
     * @param Closure $context
     */
    public function __construct(mixed $subject, Closure $context)
    {
        parent::__construct(
            $subject,
            $context,
            function (mixed $subject, Closure $context): mixed
            {
                $context($subject);
                return $subject;
            }
        );
    }
}
