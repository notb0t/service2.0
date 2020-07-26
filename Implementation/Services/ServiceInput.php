<?php
namespace Implementation\Services;

use Core\ConditionsInterface;
use Implementation\Managers\ConditionsManager;

class ServiceInput
{
    /**
     * @var ConditionsInterface
     */
    private $conditions;

    public function __construct(ConditionsInterface $conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->conditions->has($name);
    }

    /**
     * @param string $name
     * @return StrictValue
     */
    public function getValue(string $name): StrictValue
    {
        return ConditionsManager::strictValue($this->conditions->find($name)->getValue());
    }
}