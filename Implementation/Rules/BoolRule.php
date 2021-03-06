<?php declare(strict_types=1);

namespace Implementation\Rules;

use Core\RuleInterface;
use Core\RuleStateInterface;
use Implementation\Rules\Results\TrueOrErrorRuleState;

class BoolRule implements RuleInterface
{
    /**
     * @inheritDoc
     */
    public function verify($value): RuleStateInterface
    {
        return new TrueOrErrorRuleState(
            is_bool($value),
            'Value must be boolean!'
        );
    }
}
