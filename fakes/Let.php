<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Allows to use context instead of creating a new variable.
 * @template X subject type
 * @template Y result type
 * @extends SurveyEnvelope<X, Y>
 */
class Let extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @phpstan-param X $subject
     * @param mixed $subject element for context.
     */
    public function __construct(mixed $subject) {
        parent::__construct(
            $subject,
            fn ($subject, Closure $context): mixed => $context($subject) 
        );
    }
}
