<?php

namespace App\Hydrators\HydratorMembers;

use App\Hydrators\Abstracts\AbstractMember;

class BooleanMember extends AbstractMember
{
    /**
     * @var string
     */
    private $key;

    /**
     * value to map to true value.
     * @var string|bool
     */
    private $trueValue;

    /**
     * value to map to false value.
     * @var string|bool
     */
    private $falseValue;

    /**
     * BooleanMember constructor.
     * @param string      $key        key to be used in $row array in hydrator method.
     * @param string|bool $trueValue  value to map to true value.
     * @param string|bool $falseValue value to map to false value.
     */
    public function __construct(string $key, $trueValue = true, $falseValue = false)
    {
        $this->key = $key;
        $this->trueValue = $trueValue;
        $this->falseValue = $falseValue;
    }

    /**
     * {@inheritdoc}
     * @return bool
     */
    public function hydrate($row)
    {
        if (isset($row->{$this->key})) {
            if ($row->{$this->key} == $this->trueValue) {
                return true;
            } elseif ($row->{$this->key} == $this->falseValue) {
                return false;
            }
        }

        return false;
    }
}
