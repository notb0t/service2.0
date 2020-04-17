<?php

class ConditionsManager
{
    /**
     * @param ConditionInterface ...$conditions
     * @return ConditionsInterface
     */
    public static function makeList(ConditionInterface ...$conditions): ConditionsInterface
    {
        return new SimpleConditions(...$conditions);
    }

    /**
     * @param ConditionsProviderInterface $provider
     * @param array $values
     * @param array|null $names
     * @return ConditionsInterface
     */
    public static function makeListByArray(
        ConditionsProviderInterface $provider,
        array $values,
        ?array $names = null
    ): ConditionsInterface {
        $list = self::makeList();

        if ($names === null) {
            $names = array_keys($values);
        }

        foreach ($names as $name) {
            $list->add($provider->make($name, $values[$name] ?? null));
        }

        return $list;
    }

    /**
     * @param string $name
     * @param $value
     * @param RuleInterface $rule
     * @return ConditionInterface
     */
    public static function makeOne(string $name, $value, RuleInterface $rule): ConditionInterface
    {
        return new SimpleCondition($name, $value, $rule);
    }

    /**
     * @param ConditionsInterface $conditions
     * @return bool
     */
    public static function isListCanBeUsed(ConditionsInterface $conditions): bool
    {
        $result = true;

        $conditions->each(function ($item) use (&$result) {
            /** @var ConditionInterface $item */
            $result &= ConditionsManager::isCanBeUsed($item);
        });

        return (bool)$result;
    }

    /**
     * @param ConditionInterface $condition
     * @return bool
     */
    public static function isCanBeUsed(ConditionInterface $condition): bool
    {
        return $condition->followRule()->isPassed();
    }

    /**
     * @param ConditionInterface $condition
     * @return array
     */
    public static function getErrors(ConditionInterface $condition): array
    {
        return $condition->followRule()->getErrors();
    }

    /**
     * @param ConditionsInterface $conditions
     * @return array
     */
    public static function getListErrors(ConditionsInterface $conditions): array
    {
        $result = [];

        $conditions->each(function ($item) use (&$result) {
            /** @var ConditionInterface $item */
            $result[$item->getName()] = ConditionsManager::getErrors($item);
        });

        return $result;
    }

    /**
     * @param $value
     * @return StrictValue
     */
    public static function strictValue($value): StrictValue
    {
        return new StrictValue($value);
    }
}
