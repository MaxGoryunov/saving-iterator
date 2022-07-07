<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Allows to use context instead of creating a new variable.
 *
 * @template X subject type
 * @template Y result type
 *
 * @extends SurveyEnvelope<X, Y>
 */
final class Let extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @phpstan-param X $subject
     *
     * @param mixed $subject element for context.
     */
    public function __construct(mixed $subject) {
        parent::__construct(
            $subject,
            static fn ($subject, Closure $context): mixed => $context($subject)
        );
    }
}
