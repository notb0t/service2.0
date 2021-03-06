<?php declare(strict_types=1);

namespace Implementation\Rules;

use Core\RuleInterface;
use Core\RuleStateInterface;
use Implementation\Rules\Results\TrueOrErrorRuleState;

class OneOfRule implements RuleInterface
{
    /**
     * @var array
     */
    private $values;
    /**
     * @var bool
     */
    private $strict;

    public function __construct(array $values, bool $strict = false)
    {
        $this->values = $values;
        $this->strict = $strict;
    }

    /**
     * @inheritDoc
     */
    public function verify($value): RuleStateInterface
    {
        return new TrueOrErrorRuleState(
            in_array(
                $value,
                $this->values,
                $this->strict
            ),
            'Value must be one of items: ' . implode(',', $this->values)
        );
    }
}
