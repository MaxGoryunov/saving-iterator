<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Allows to use context instead of creating a new variable.
 * 
 * @template X subject type
 * @template Y result type
 * @extends SurveyEnvelope<X, Y>
 */
class Let extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @phpstan-param X             $subject repeated element
     * @phpstan-param Closure(X): Y $context context for element
     * @param mixed   $subject element to be put into context
     * @param Closure $context context for element
     */
    public function __construct(mixed $subject, Closure $context)
    {
        parent::__construct(
            $subject,
            $context,
            fn(mixed $subject, Closure $context): mixed => $context($subject)
        );
    }
}
