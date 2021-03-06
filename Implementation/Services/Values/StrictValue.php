<?php declare(strict_types=1);

namespace Implementation\Services;

class StrictValue implements StrictValueInterface
{
    private $value;

    /**
     * StrictValue constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function asInt(): int
    {
        return (int)$this->value;
    }

    /**
     * @return bool
     */
    public function asBool(): bool
    {
        return (bool)$this->value;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return (string)$this->value;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return (array)$this->value;
    }

    /**
     * @return mixed
     */
    public function original()
    {
        return $this->value;
    }

    public function asFloat(?int $precision = null): float
    {
        return (float)number_format((float) $this->value, $precision, '.', '');
    }
}
