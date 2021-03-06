<?php declare(strict_types=1);

namespace Implementation\Services;

interface StrictValueInterface
{
    /**
     * @return int
     */
    public function asInt(): int;

    /**
     * @param int|null $precision
     * @return float
     */
    public function asFloat(?int $precision = null): float;

    /**
     * @return bool
     */
    public function asBool(): bool;

    /**
     * @return string
     */
    public function asString(): string;

    /**
     * @return array
     */
    public function asArray(): array;

    /**
     * @return mixed
     */
    public function original();
}